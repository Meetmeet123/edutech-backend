<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentCheckinCheckout
 * 
 * @property int $id
 * @property int $student_session_id
 * @property Carbon $checkin_date_time
 * @property Carbon $checkout_date_time
 * @property bool $approved_by
 * @property bool $status
 *
 * @package App\Models
 */
class StudentCheckinCheckout extends Model
{
	protected $table = 'student_checkin_checkout';
	public $timestamps = false;

	protected $casts = [
		'student_session_id' => 'int',
		'checkin_date_time' => 'datetime',
		'checkout_date_time' => 'datetime',
		'approved_by' => 'bool',
		'status' => 'bool'
	];

	protected $fillable = [
		'student_session_id',
		'checkin_date_time',
		'checkout_date_time',
		'approved_by',
		'status'
	];
}
