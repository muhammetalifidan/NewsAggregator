<?php

namespace App\Contracts\Api;

use App\Models\IncomingLog;

interface IncomingLogRepositoryInterface
{
    public function getInsertedRecords();
    public function store(IncomingLog $incomingLog): IncomingLog;
}
