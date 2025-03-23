<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSubjectwiseRemark extends Model
{
    // Table name (optional if following Laravel convention)
    protected $table = 'exam_subjectwise_remarks';

    // Fillable fields for mass assignment
    protected $fillable = [
        'exam_id',
        'subject_id',
        'student_id',
        'session_id',
        'teacher_id',
        'remark',
    ];

    // Relationships
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id'); // Assuming User model for teachers
    }

    // Static method to get remarks by exam and subject (example utility)
    public static function getByExamAndSubject($exam_id, $subject_id)
    {
        return self::where('exam_id', $exam_id)
                   ->where('subject_id', $subject_id)
                   ->with(['student', 'subject', 'teacher'])
                   ->get();
    }
}