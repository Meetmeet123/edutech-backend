<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentFeesDiscount
 * 
 * @property int $id
 * @property int|null $student_session_id
 * @property int|null $fees_discount_id
 * @property string|null $status
 * @property string|null $payment_id
 * @property string|null $description
 * @property string $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class StudentFeesDiscount extends Model
{
	protected $table = 'student_fees_discounts';
	public $timestamps = false;

	protected $casts = [
		'student_session_id' => 'int',
		'fees_discount_id' => 'int'
	];

	protected $fillable = [
		'student_session_id',
		'fees_discount_id',
		'status',
		'payment_id',
		'description',
		'is_active'
	];
}
