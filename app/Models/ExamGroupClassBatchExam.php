<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamGroupClassBatchExam extends Model
{
    protected $table = 'exam_group_class_batch_exams';
    protected $fillable = [
        'exam_group_id',
        'session_id',
        'exam',
        'is_active',
        'is_publish',
        'description',
        'use_exam_roll_no',
        'parent_exam_id',
        'class_batch_id' // Uncomment if applicable
    ];
    public $timestamps = false;

    // Relationships
    public function examGroup()
    {
        return $this->belongsTo(ExamGroup::class, 'exam_group_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function subjects()
    {
        return $this->hasMany(ExamGroupClassBatchExamSubject::class, 'exam_group_class_batch_exams_id');
    }

    public function connections()
    {
        return $this->hasMany(ExamGroupExamConnection::class, 'exam_group_class_batch_exams_id');
    }
}