<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSubject extends Model
{
    // Table name (optional if following Laravel convention)
    protected $table = 'exam_subjects';

    // Fillable fields for mass assignment
    protected $fillable = [
        'exam_group_class_batch_exam_id',
        'subject_id',
        'credit_hours',
        'date_from',
        'time_from',
        'duration',
        'room_no',
        'max_marks',
        'min_marks',
    ];

    // Casts for proper data type handling
    protected $casts = [
        'date_from' => 'date',
        'time_from' => 'datetime:H:i:s',
        'max_marks' => 'integer',
        'min_marks' => 'integer',
    ];

    // Relationships
    public function examGroupClassBatchExam()
    {
        return $this->belongsTo(ExamGroupClassBatchExam::class, 'exam_group_class_batch_exam_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    // Static method to get exam subjects by exam ID (used in examSubjects method)
    public static function getByExamId($exam_id)
    {
        return self::where('exam_group_class_batch_exam_id', $exam_id)->with('subject')->get();
    }
}