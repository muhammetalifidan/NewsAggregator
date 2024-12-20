<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncomingLogListResource extends JsonResource
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
            'incoming_log_data' => new IncomingLogDataResource($this->incomingLogData()),
            'source' => $this->source,
            'title' => $this->title,
            'word_count' => $this->word_count,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
