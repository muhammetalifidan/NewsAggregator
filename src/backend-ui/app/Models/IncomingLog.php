<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomingLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'incoming_log_data_id',
        'source',
        'title',
        'word_count',
    ];

    public function incomingLogData(): BelongsTo
    {
        return $this->belongsTo(IncomingLogData::class);
    }

    public function callbackLogs(): HasMany
    {
        return $this->hasMany(CallbackLog::class);
    }
}
