<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StaffPayslip
 * 
 * @property int $id
 * @property int $staff_id
 * @property string|null $basic
 * @property string|null $total_allowance
 * @property string|null $total_deduction
 * @property int $leave_deduction
 * @property string $tax
 * @property string|null $net_salary
 * @property string $status
 * @property string|null $leave_days
 * @property string|null $loan_deduction
 * @property string $month
 * @property string $year
 * @property string $payment_mode
 * @property Carbon $payment_date
 * @property string $remark
 *
 * @package App\Models
 */
class StaffPayslip extends Model
{
	protected $table = 'staff_payslip';
	public $timestamps = false;

	protected $casts = [
		'staff_id' => 'int',
		'leave_deduction' => 'int',
		'payment_date' => 'datetime'
	];

	protected $fillable = [
		'staff_id',
		'basic',
		'total_allowance',
		'total_deduction',
		'leave_deduction',
		'tax',
		'net_salary',
		'status',
		'leave_days',
		'loan_deduction',
		'month',
		'year',
		'payment_mode',
		'payment_date',
		'remark'
	];
}
