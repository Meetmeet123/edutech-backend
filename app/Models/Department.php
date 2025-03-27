<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 * 
 * @property int $id
 * @property string $department_name
 * @property string $is_active
 *
 * @package App\Models
 */
class Department extends Model
{
	protected $table = 'department';
	public $timestamps = false;

	protected $fillable = [
		'department_name',
		'is_active'
	];
}
