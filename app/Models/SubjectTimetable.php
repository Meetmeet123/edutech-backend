<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTimetable extends Model
{
    // Table name (optional if following Laravel convention)
    protected $table = 'subject_timetables';

    // Fillable fields for mass assignment
    protected $fillable = [
        'subject_id',
        'class_id',
        'batch_id',
        'day',
        'time_from',
        'time_to',
        'room_no',
        'session_id',
        'exam_group_id',
    ];

    // Casts for proper data type handling
    protected $casts = [
        'time_from' => 'datetime:H:i:s',
        'time_to' => 'datetime:H:i:s',
    ];

    // Relationships
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function examGroup()
    {
        return $this->belongsTo(ExamGroup::class, 'exam_group_id');
    }

    // Static method to get timetable by exam group (example utility)
    public static function getByExamGroup($exam_group_id)
    {
        return self::where('exam_group_id', $exam_group_id)->with(['subject', 'class'])->get();
    }
}