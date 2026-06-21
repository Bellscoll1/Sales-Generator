<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'conversation_id',
        'organization_id',
        'sender_id',
        'direction',
        'body',
        'scheduled_for',
        'sent_at',
        'meta',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_for' => 'datetime',
            'sent_at' => 'datetime',
            'meta' => 'array',
        ];
    }
}
