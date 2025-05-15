<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'message',
        'schedule_date',
        'expire_date',
        'status',
    ];

    protected $casts = [
        'schedule_date' => 'datetime',
        'expire_date' => 'datetime',
        'status' => 'boolean',
    ];
}
