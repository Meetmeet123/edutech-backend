<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamGroupStudent extends Model
{
    protected $table = 'exam_group_students';
    protected $fillable = ['exam_group_id', 'student_id', 'student_session_id'];
    public $timestamps = false;

    // Relationships
    public function examGroup()
    {
        return $this->belongsTo(ExamGroup::class, 'exam_group_id');
    }

    public function studentSession()
    {
        return $this->belongsTo(StudentSession::class, 'student_session_id');
    }

    public function results()
    {
        return $this->hasMany(ExamGroupExamResult::class, 'exam_group_student_id');
    }
}