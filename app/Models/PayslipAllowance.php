<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PayslipAllowance
 * 
 * @property int $id
 * @property int $payslip_id
 * @property string $allowance_type
 * @property float $amount
 * @property int $staff_id
 * @property string $cal_type
 *
 * @package App\Models
 */
class PayslipAllowance extends Model
{
	protected $table = 'payslip_allowance';
	public $timestamps = false;

	protected $casts = [
		'payslip_id' => 'int',
		'amount' => 'float',
		'staff_id' => 'int'
	];

	protected $fillable = [
		'payslip_id',
		'allowance_type',
		'amount',
		'staff_id',
		'cal_type'
	];
}
