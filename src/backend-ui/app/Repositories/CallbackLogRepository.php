<?php

namespace App\Repositories;

use App\Contracts\CallbackLogRepositoryInterface;
use App\Http\Resources\CallbackLogListResource;
use App\Http\Resources\CallbackLogResource;
use App\Models\CallbackLog;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CallbackLogRepository implements CallbackLogRepositoryInterface
{
    public function all(int $perPage = 10, ?string $search = null): ResourceCollection
    {
        $query = CallbackLog::query();

        $query->where(function ($q) use ($search) {
            $q->where('status', 'like', "%{$search}%")
                ->orWhere('result', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%")
                ->orWhere('created_at', 'like', "%{$search}%");
        });

        $results = $query->paginate($perPage);

        return CallbackLogListResource::collection($results);
    }

    public function find(CallbackLog $callbackLog): CallbackLogResource
    {
        return new CallbackLogResource($callbackLog);
    }

    public function store(CallbackLog $callbackLog): CallbackLog
    {
        $callbackLog->save();

        return $callbackLog;
    }
}
