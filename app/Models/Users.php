<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Users extends Model
{
    use HasFactory;

    //create user model
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'firstName',
        'lastName',
        'username',
        'password',
        'email',
        'phone',
        'street',
        'city',
        'state',
        'zipCode',
        'country',
        'joinDate',
        'leaveDate',
        'employeeId',
        'bloodGroup',
        'image',
        'employmentStatusId',
        'departmentId',
        'roleId',
        'shiftId',
        'leavePolicyId',
        'weeklyHolidayId',
    ];

    public function employmentStatus(): BelongsTo
    {
        return $this->belongsTo(EmploymentStatus::class, 'employmentStatusId');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'departmentId');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'roleId');
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class, 'shiftId');
    }

    public function leavePolicy(): BelongsTo
    {
        return $this->belongsTo(LeavePolicy::class, 'leavePolicyId');
    }

    public function weeklyHoliday(): BelongsTo
    {
        return $this->belongsTo(WeeklyHoliday::class, 'weeklyHolidayId');
    }

    //designationHistory
    public function designationHistory(): HasMany
    {
        return $this->hasMany(DesignationHistory::class, 'userId');
    }

    public function education(): HasMany
    {
        return $this->hasMany(Education::class, 'userId');
    }

    public function awardHistory(): HasMany
    {
        return $this->hasMany(AwardHistory::class, 'userId');
    }

    //relation with project
    public function project(): HasMany
    {
        return $this->hasMany(Project::class, 'projectManagerId');
    }
    public function leaveApplication(): HasMany
    {
        return $this->hasMany(LeaveApplication::class, 'userId');
    }

    public function salaryHistory(): HasMany
    {
        return $this->hasMany(SalaryHistory::class, 'userId');
    }

    //attendance
    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class, 'userId');
    }
}
