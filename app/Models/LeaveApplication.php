<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $table = 'leaveApplication';
    protected $primaryKey = 'id';
    protected $fillable = [
        'userId',
        'leaveType',
        'leaveFrom',
        'leaveTo',
        'acceptLeaveFrom',
        'acceptLeaveTo',
        'acceptLeaveBy',
        'leaveDuration',
        'reason',
        'reviewComment',
        'attachment',
        'status',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'userId');
    }

}
