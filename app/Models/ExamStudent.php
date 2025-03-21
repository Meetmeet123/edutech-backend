<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamStudent extends Model
{
    // Table name (optional if following Laravel convention)
    protected $table = 'exam_students';

    // Fillable fields for mass assignment
    protected $fillable = [
        'exam_id',
        'student_id',
        'session_id',
        'exam_roll_no',
        'is_present',
    ];

    // Casts for proper data type handling
    protected $casts = [
        'is_present' => 'boolean',
    ];

    // Relationships
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    // Static method to get students by exam, class, and section (used in examStudent)
    public static function getByExamAndClassSection($exam_id, $class_id, $section_id)
    {
        return self::where('exam_id', $exam_id)
                   ->whereHas('student', function ($query) use ($class_id, $section_id) {
                       $query->where('class_id', $class_id)
                             ->where('section_id', $section_id);
                   })
                   ->with('student')
                   ->get();
    }
}