<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallbackLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'incoming_log_id',
        'result',
        'status',
    ];

    public function incomingLog(): BelongsTo
    {
        return $this->belongsTo(IncomingLog::class);
    }
}
