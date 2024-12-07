<?php

namespace App\Repositories\Api;

use App\Contracts\Api\IncomingLogDataRepositoryInterface;
use App\Models\IncomingLogData;

class IncomingLogDataRepository implements IncomingLogDataRepositoryInterface
{
    public function store(IncomingLogData $incomingLogData): IncomingLogData
    {
        $incomingLogData->save();

        return $incomingLogData;
    }
}
