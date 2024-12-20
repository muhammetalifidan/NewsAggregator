<?php

namespace App\Contracts;

use App\Models\IncomingLogData;

interface IncomingLogDataRepositoryInterface
{
    public function store(IncomingLogData $incomingLogData): IncomingLogData;
}
