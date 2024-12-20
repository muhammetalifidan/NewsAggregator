<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CallbackLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'incoming_log_id' => $this->incoming_log_id,
            'result' => $this->result,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at ? $this->updated_at->toDateTimeString() : null,
            'deleted_at' => $this->deleted_at ? $this->deleted_at->toDateTimeString() : null,
        ];
    }
}
