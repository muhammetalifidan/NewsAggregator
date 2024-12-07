<?php

namespace App\Contracts\Api;

use App\Models\IncomingLogData;

interface IncomingLogDataRepositoryInterface
{
    public function store(IncomingLogData $incomingLogData): IncomingLogData;
}
