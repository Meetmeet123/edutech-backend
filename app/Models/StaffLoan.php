<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StaffLoan
 * 
 * @property int $id
 * @property int $staff_id
 * @property string $loan_amount
 * @property string $actual_loan_amount
 * @property string $emi_amount
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class StaffLoan extends Model
{
	protected $table = 'staff_loan';

	protected $casts = [
		'staff_id' => 'int'
	];

	protected $fillable = [
		'staff_id',
		'loan_amount',
		'actual_loan_amount',
		'emi_amount'
	];
}
