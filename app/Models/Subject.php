<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable = ['name', 'code', 'type']; // Adjust based on your schema
    public $timestamps = false;

    // Relationships
    public function examSubjects()
    {
        return $this->hasMany(ExamGroupClassBatchExamSubject::class, 'subject_id');
    }
}