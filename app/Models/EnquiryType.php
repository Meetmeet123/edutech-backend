<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnquiryType extends Model // Repeat for Source, ComplaintType, Reference
{
    protected $table = 'enquiry_type'; // source, complaint_type, reference
    protected $fillable = ['name'];
}
