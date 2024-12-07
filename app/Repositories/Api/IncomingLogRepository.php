<?php

namespace App\Repositories\Api;

use App\Contracts\Api\IncomingLogRepositoryInterface;
use App\Models\IncomingLog;

class IncomingLogRepository implements IncomingLogRepositoryInterface
{
    public function getInsertedRecords()
    {
        return IncomingLog::get()->select(['title', 'word_count'])->toArray();
    }

    public function store(IncomingLog $incomingLog): IncomingLog
    {
        $incomingLog->save();

        return $incomingLog;
    }
}
