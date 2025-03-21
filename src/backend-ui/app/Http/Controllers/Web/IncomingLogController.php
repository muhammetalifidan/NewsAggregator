<?php

namespace App\Http\Controllers\Web;

use App\Contracts\IncomingLogRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\IncomingLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class IncomingLogController extends Controller
{
    private IncomingLogRepositoryInterface $incomingLogRepository;

    public function __construct(IncomingLogRepositoryInterface $incomingLogRepository)
    {
        $this->incomingLogRepository = $incomingLogRepository;
    }

    public function index(Request $request): View
    {
        Gate::authorize('viewAny', IncomingLog::class);

        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        $page = $request->get('page', 1);

        if (empty($perPage) || $perPage <= 0) {
            $perPage = 10;
        }

        $incomingLogs = Cache::tags(['incoming_logs'])->remember(
            key: "incoming_logs:per_page={$perPage}:page={$page}:search={$search}",
            ttl: now()->addHour(),
            callback: fn() => $this->incomingLogRepository->all($perPage, $search)
        );

        if ($request->ajax()) {
            return view('pages.incoming-logs.table', compact('incomingLogs'));
        }
        return view('pages.incoming-logs.index', compact('incomingLogs', 'perPage', 'search'));
    }

    public function show(IncomingLog $incomingLog)
    {
        Gate::authorize('view', IncomingLog::class);

        $incomingLog = Cache::remember(
            key: "incoming_log:{$incomingLog->id}",
            ttl: now()->addHour(),
            callback: fn() => $this->incomingLogRepository->find($incomingLog)
        );

        return view('pages.incoming-logs.show', compact('incomingLog'));
    }
}
