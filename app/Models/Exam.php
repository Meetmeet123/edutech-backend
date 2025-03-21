<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['exam_group_id', 'name', 'is_active'];

    public function examStudents()
    {
        return $this->hasMany(ExamStudent::class, 'exam_id');
    }

    public function examGroup()
    {
        return $this->belongsTo(ExamGroup::class, 'exam_group_id');
    }
}