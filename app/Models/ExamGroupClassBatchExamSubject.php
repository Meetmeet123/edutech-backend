<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamGroupClassBatchExamSubject extends Model
{
    protected $table = 'exam_group_class_batch_exam_subjects';
    protected $fillable = [
        'exam_group_class_batch_exams_id',
        'subject_id',
        'credit_hours',
        'date_from',
        'date_to',
        'time_from',
        'duration',
        'room_no',
        'max_marks',
        'min_marks',
        'class_batch_subject_id' // Uncomment if applicable
    ];
    public $timestamps = false;

    // Relationships
    public function exam()
    {
        return $this->belongsTo(ExamGroupClassBatchExam::class, 'exam_group_class_batch_exams_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}