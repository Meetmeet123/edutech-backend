<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StaffDesignation
 * 
 * @property int $id
 * @property string $designation
 * @property string $is_active
 *
 * @package App\Models
 */
class StaffDesignation extends Model
{
	protected $table = 'staff_designation';
	public $timestamps = false;

	protected $fillable = [
		'designation',
		'is_active'
	];
}
