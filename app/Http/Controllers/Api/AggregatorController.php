<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Api\CallbackLogRepositoryInterface;
use App\Contracts\Api\IncomingLogDataRepositoryInterface;
use App\Contracts\Api\IncomingLogRepositoryInterface;
use App\Enum\CallbackLogStatusType;
use App\Http\Controllers\Controller;
use App\Models\CallbackLog;
use App\Models\IncomingLog;
use App\Models\IncomingLogData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AggregatorController extends Controller
{
    private CallbackLogRepositoryInterface $callbackLogRepository;
    private IncomingLogDataRepositoryInterface $incomingLogDataRepository;
    private IncomingLogRepositoryInterface $incomingLogRepository;

    public function __construct(
        CallbackLogRepositoryInterface $callbackLogRepository,
        IncomingLogDataRepositoryInterface $incomingLogDataRepository,
        IncomingLogRepositoryInterface $incomingLogRepository
    ) {
        $this->callbackLogRepository = $callbackLogRepository;
        $this->incomingLogDataRepository = $incomingLogDataRepository;
        $this->incomingLogRepository = $incomingLogRepository;
    }

    public function callback(Request $request): JsonResponse
    {
        if (!$request->isJson() || !is_array($request->json()->all())) {
            return response()->json(['error' => 'Invalid request format'], 400);
        }

        $payload = $request->json()->all();
        $insertedRecords = $this->incomingLogRepository->getInsertedRecords();

        if ($insertedRecords === null) {
            $inserted = $payload;
        } else {
            $udiff = array_udiff(
                $payload,
                $insertedRecords,
                function ($p, $ir) {
                    return strcmp(json_encode($p), json_encode($ir));
                }
            );
            $inserted = json_encode(array_values($udiff), JSON_PRETTY_PRINT);
        }

        DB::transaction(function () use ($payload, $inserted) {
            $incomingLogData = $this->storeIncomingLogData($payload, $inserted);
            $incomingLogs = $this->storeIncomingLog($incomingLogData);

            foreach ($incomingLogs as $incomingLog) {
                $response = $this->testReciever($incomingLog);
                $result = $response->getData(true);

                $this->storeCallbackLog(
                    $incomingLog->id,
                    json_encode($result),
                    CallbackLogStatusType::Confirmed->value
                );
            }
        }, 2);

        return response()->json(
            [
                'success' => true,
                'message' => 'News synced successfully',
            ],
            200
        );
    }

    private function storeIncomingLogData($payload, $inserted = null): IncomingLogData
    {
        $incomingLogData = new IncomingLogData();
        $incomingLogData->payload = json_encode($payload);
        $incomingLogData->inserted = $inserted;

        return $this->incomingLogDataRepository->store($incomingLogData);
    }

    private function storeIncomingLog(IncomingLogData $incomingLogData): array
    {
        $logEntries = json_decode($incomingLogData->inserted);
        $incomingLogs = [];

        if (!empty($logEntries)) {
            foreach ($logEntries as $entry) {
                $incomingLog = new IncomingLog();
                $incomingLog->incoming_log_data_id = $incomingLogData->id;
                $incomingLog->title = $entry->title;
                $incomingLog->word_count = $entry->word_count;
                $incomingLog->source = 'https://www.ilkduy.com';

                $storedIncomingLog = $this->incomingLogRepository->store($incomingLog);
                array_push($incomingLogs, $storedIncomingLog);
            }
        }

        return $incomingLogs;
    }

    private function testReciever(IncomingLog $incomingLog): JsonResponse
    {
        return response()->json(['ok' => true, 'title' => $incomingLog->title]);
    }

    private function storeCallbackLog(int $incoming_log_id, string $result, string $status): CallbackLog
    {
        $callbackLog = new CallbackLog();
        $callbackLog->incoming_log_id = $incoming_log_id;
        $callbackLog->result = $result;
        $callbackLog->status = $status;

        return $this->callbackLogRepository->store($callbackLog);
    }
}
