<?php

namespace App\Repositories;

use App\Contracts\IncomingLogDataRepositoryInterface;
use App\Models\IncomingLogData;

class IncomingLogDataRepository implements IncomingLogDataRepositoryInterface
{
    public function store(IncomingLogData $incomingLogData): IncomingLogData
    {
        $incomingLogData->save();

        return $incomingLogData;
    }
}
