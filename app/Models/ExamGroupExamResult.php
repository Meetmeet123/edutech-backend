<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamGroupExamResult extends Model
{
    protected $table = 'exam_group_exam_results';
    protected $fillable = [
        'exam_group_student_id',
        'exam_group_class_batch_exam_subject_id',
        'get_marks',
        'attendence',
        'note'
    ];
    public $timestamps = false;

    // Relationships
    public function examGroupStudent()
    {
        return $this->belongsTo(ExamGroupStudent::class, 'exam_group_student_id');
    }

    public function examSubject()
    {
        return $this->belongsTo(ExamGroupClassBatchExamSubject::class, 'exam_group_class_batch_exam_subject_id');
    }
}