<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StaffPayroll
 * 
 * @property int $id
 * @property int $basic_salary
 * @property string $pay_scale
 * @property string $grade
 * @property string $is_active
 *
 * @package App\Models
 */
class StaffPayroll extends Model
{
	protected $table = 'staff_payroll';
	public $timestamps = false;

	protected $casts = [
		'basic_salary' => 'int'
	];

	protected $fillable = [
		'basic_salary',
		'pay_scale',
		'grade',
		'is_active'
	];
}
