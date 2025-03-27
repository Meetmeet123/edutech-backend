<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EnquiryType
 * 
 * @property int $id
 * @property string $enquiry_type
 * @property string $description
 *
 * @package App\Models
 */
class EnquiryType extends Model
{
	protected $table = 'enquiry_type';
	public $timestamps = false;

	protected $fillable = [
		'enquiry_type',
		'description'
	];
}
