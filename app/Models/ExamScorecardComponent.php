<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamScorecardComponent extends Model
{
    // Table name (optional if following Laravel convention)
    protected $table = 'exam_scorecard_components';

    // Fillable fields for mass assignment
    protected $fillable = [
        'exam_id',
        'student_id',
        'subject_id',
        'mark_dist_component_id',
        'exam_class_subjects_component_id',
        'session_id',
        'marks_obtained',
    ];

    // Casts for proper data type handling
    protected $casts = [
        'marks_obtained' => 'decimal:2',
    ];

    // Relationships
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function markDistributionComponent()
    {
        return $this->belongsTo(ExamMarksDistributionComponent::class, 'mark_dist_component_id');
    }

    public function examClassSubjectsComponent()
    {
        return $this->belongsTo(ExamClassSubjectsComponent::class, 'exam_class_subjects_component_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    // Static method to get scorecard components by exam and student (example utility)
    public static function getByExamAndStudent($exam_id, $student_id)
    {
        return self::where('exam_id', $exam_id)
                   ->where('student_id', $student_id)
                   ->with(['subject', 'markDistributionComponent', 'examClassSubjectsComponent'])
                   ->get();
    }
}