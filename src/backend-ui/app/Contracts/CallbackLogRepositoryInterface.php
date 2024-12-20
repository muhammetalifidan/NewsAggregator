<?php

namespace App\Contracts;

use App\Http\Resources\CallbackLogResource;
use App\Models\CallbackLog;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface CallbackLogRepositoryInterface
{
    public function all(int $perPage = 10, ?string $search = null): ResourceCollection;
    public function find(CallbackLog $callbackLog): CallbackLogResource;
    public function store(CallbackLog $callbackLog): CallbackLog;
}
