<?php

namespace App\Contracts;

use App\Http\Resources\IncomingLogResource;
use App\Models\IncomingLog;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface IncomingLogRepositoryInterface
{
    public function all(int $perPage = 10, ?string $search = null): ResourceCollection;
    public function find(IncomingLog $incomingLog): IncomingLogResource;
}
