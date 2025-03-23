<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectGroup extends Model
{
    // Table name (optional if following Laravel convention)
    protected $table = 'subject_groups';

    // Fillable fields for mass assignment
    protected $fillable = [
        'name',
        'class_id',
        'session_id',
        'description',
        'is_active',
    ];

    // Casts for proper data type handling
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_group_subjects', 'subject_group_id', 'subject_id')
                    ->withTimestamps();
    }

    // Static method to get subject groups by class and session (example utility)
    public static function getByClassAndSession($class_id, $session_id)
    {
        return self::where('class_id', $class_id)
                   ->where('session_id', $session_id)
                   ->where('is_active', 1)
                   ->with('subjects')
                   ->get();
    }
}