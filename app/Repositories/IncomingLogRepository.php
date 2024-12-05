<?php

namespace App\Repositories;

use App\Contracts\IncomingLogRepositoryInterface;
use App\Http\Resources\IncomingLogListResource;
use App\Http\Resources\IncomingLogResource;
use App\Models\IncomingLog;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IncomingLogRepository implements IncomingLogRepositoryInterface
{
    public function all(int $perPage = 10, ?string $search = null): ResourceCollection
    {
        $query = IncomingLog::query();

        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
                ->orWhere('word_count', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%")
                ->orWhere('created_at', 'like', "%{$search}%")
                ->orWhere('source', 'like', "%{$search}%");
        });

        $results = $query->paginate($perPage);

        return IncomingLogListResource::collection($results);
    }

    public function find(IncomingLog $incomingLog): IncomingLogResource
    {
        return new IncomingLogResource($incomingLog);
    }
}
