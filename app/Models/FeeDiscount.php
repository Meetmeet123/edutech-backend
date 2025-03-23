<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FeeDiscount extends Model
{
    // Table name (optional if following Laravel convention)
    protected $table = 'fee_discounts';

    // Fillable fields for mass assignment
    protected $fillable = [
        'name',
        'description',
        'amount',
        'is_active',
    ];

    // Casts for proper data type handling
    protected $casts = [
        'amount' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relationship with student sessions (pivot table assumed)
    public function studentSessions()
    {
        return $this->belongsToMany(StudentSession::class, 'student_fee_discounts', 'fee_discount_id', 'student_session_id')
                    ->withPivot('applied_at')
                    ->withTimestamps();
    }

    // Static method to get discounts not applied to a student session
    public static function notAppliedToStudentSession($student_session_id)
    {
        $appliedDiscountIds = DB::table('student_fee_discounts')
            ->where('student_session_id', $student_session_id)
            ->pluck('fee_discount_id');

        return self::whereNotIn('id', $appliedDiscountIds)
                   ->where('is_active', 1)
                   ->get();
    }
}