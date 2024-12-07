<?php

namespace App\Contracts\Api;

use App\Models\CallbackLog;

interface CallbackLogRepositoryInterface
{
    public function store(CallbackLog $callbackLog): CallbackLog;
}
