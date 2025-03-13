<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    protected $primaryKey = 'id';
    protected $fillable = ['class'];

    // Relationships
    public function sections()
    {
        return $this->hasMany(Section::class, 'class_id');
    }

    public function studentSessions()
    {
        return $this->hasMany(StudentSession::class, 'class_id');
    }
}