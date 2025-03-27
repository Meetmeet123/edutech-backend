<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentFee
 * 
 * @property int $id
 * @property int|null $student_session_id
 * @property int|null $feemaster_id
 * @property float|null $amount
 * @property float $amount_discount
 * @property float $amount_fine
 * @property string|null $description
 * @property Carbon|null $date
 * @property string $payment_mode
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class StudentFee extends Model
{
	protected $table = 'student_fees';

	protected $casts = [
		'student_session_id' => 'int',
		'feemaster_id' => 'int',
		'amount' => 'float',
		'amount_discount' => 'float',
		'amount_fine' => 'float',
		'date' => 'datetime'
	];

	protected $fillable = [
		'student_session_id',
		'feemaster_id',
		'amount',
		'amount_discount',
		'amount_fine',
		'description',
		'date',
		'payment_mode',
		'is_active'
	];
}
