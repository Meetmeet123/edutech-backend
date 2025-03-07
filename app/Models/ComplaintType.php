<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintType extends Model
{
    protected $table = 'complaint_type'; 
    protected $fillable = ['name'];
}
