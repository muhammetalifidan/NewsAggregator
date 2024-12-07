<?php

namespace App\Repositories\Api;

use App\Contracts\Api\CallbackLogRepositoryInterface;
use App\Models\CallbackLog;

class CallbackLogRepository implements CallbackLogRepositoryInterface
{
    public function store(CallbackLog $callbackLog): CallbackLog
    {
        $callbackLog->save();

        return $callbackLog;
    }
}
