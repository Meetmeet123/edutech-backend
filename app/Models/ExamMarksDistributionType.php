<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamMarksDistributionType extends Model
{
    // Table name (optional if following Laravel convention)
    protected $table = 'exam_marks_distribution_types';

    // Fillable fields for mass assignment
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    // Casts for proper data type handling
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationship with components (if applicable)
    public function components()
    {
        return $this->hasMany(ExamMarksDistributionComponent::class, 'mark_dist_type_id');
    }

    // Static method to get all active distribution types (example utility)
    public static function getActiveTypes()
    {
        return self::where('is_active', 1)->get();
    }
}