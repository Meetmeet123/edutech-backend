<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    // Table name (optional if following Laravel convention)
    protected $table = 'grades';

    // Fillable fields for mass assignment
    protected $fillable = [
        'name',
        'min_marks',
        'max_marks',
        'exam_group_id',
        'session_id',
        'description',
        'is_active',
    ];

    // Casts for proper data type handling
    protected $casts = [
        'min_marks' => 'decimal:2',
        'max_marks' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function examGroup()
    {
        return $this->belongsTo(ExamGroup::class, 'exam_group_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    // Static method to get grades by exam group (example utility)
    public static function getByExamGroup($exam_group_id)
    {
        return self::where('exam_group_id', $exam_group_id)
                   ->where('is_active', 1)
                   ->orderBy('min_marks', 'asc')
                   ->get();
    }

    // Method to determine grade for a given mark
    public static function getGradeForMarks($marks, $exam_group_id)
    {
        return self::where('exam_group_id', $exam_group_id)
                   ->where('min_marks', '<=', $marks)
                   ->where('max_marks', '>=', $marks)
                   ->where('is_active', 1)
                   ->first();
    }
}