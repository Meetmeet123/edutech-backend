<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchSubject extends Model
{
    protected $fillable = ['exam_group_id', 'subject_id', 'credit_hours', 'date_from', 'time_from', 'duration', 'room_no', 'max_marks', 'min_marks'];

    public static function getExamSubjects($exam_group_id)
    {
        return self::where('exam_group_id', $exam_group_id)->get();
    }
}