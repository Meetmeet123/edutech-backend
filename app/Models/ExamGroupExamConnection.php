<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamGroupExamConnection extends Model
{
    protected $table = 'exam_group_exam_connections';
    protected $fillable = ['exam_group_id', 'exam_group_class_batch_exams_id', 'exam_weightage'];
    public $timestamps = false;

    // Relationships
    public function examGroup()
    {
        return $this->belongsTo(ExamGroup::class, 'exam_group_id');
    }

    public function exam()
    {
        return $this->belongsTo(ExamGroupClassBatchExam::class, 'exam_group_class_batch_exams_id');
    }
}