<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'sessions';
    protected $primaryKey = 'id'; // id is the primary key

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
        'session',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',       // Cast status to boolean
        'last_activity' => 'integer', // Cast last_activity to integer
        'created_at' => 'datetime',   // Cast timestamps to datetime
        'updated_at' => 'datetime',
    ];

    // Relationships (optional, based on your needs)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}