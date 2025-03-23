<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamClassSubjectsComponent extends Model
{
    // Table name (optional if following Laravel convention)
    protected $table = 'exam_class_subjects_components';

    // Fillable fields for mass assignment
    protected $fillable = [
        'exam_id',
        'class_id',
        'subject_id',
        'mark_dist_component_id',
        'session_id',
        'max_marks',
        'weightage',
    ];

    // Casts for proper data type handling
    protected $casts = [
        'max_marks' => 'decimal:2',
        'weightage' => 'decimal:2', // e.g., percentage contribution
    ];

    // Relationships
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function markDistributionComponent()
    {
        return $this->belongsTo(ExamMarksDistributionComponent::class, 'mark_dist_component_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    // Static method to get components by exam, class, and subject (example utility)
    public static function getByExamClassSubject($exam_id, $class_id, $subject_id)
    {
        return self::where('exam_id', $exam_id)
                   ->where('class_id', $class_id)
                   ->where('subject_id', $subject_id)
                   ->with(['subject', 'markDistributionComponent'])
                   ->get();
    }
}