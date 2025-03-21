<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamMarksDistributionComponent extends Model
{
    // Table name (optional if following Laravel convention)
    protected $table = 'exam_mark_distribution_components';

    // Fillable fields for mass assignment
    protected $fillable = [
        'mark_dist_type_id',
        'name',
        'description',
        'is_active',
    ];

    // Casts for proper data type handling
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationship with mark distribution type
    public function markDistributionType()
    {
        return $this->belongsTo(ExamMarksDistributionType::class, 'mark_dist_type_id');
    }

    // Static method to get components by type (example utility)
    public static function getByType($mark_dist_type_id)
    {
        return self::where('mark_dist_type_id', $mark_dist_type_id)
                   ->where('is_active', 1)
                   ->get();
    }
}