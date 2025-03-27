<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentFeesMaster
 * 
 * @property int $id
 * @property int $is_system
 * @property int|null $student_session_id
 * @property int|null $fee_session_group_id
 * @property int|null $fee_head_course_id
 * @property float|null $amount
 * @property string $is_active
 * @property Carbon $created_at
 * 
 * @property Collection|OfflineFeesPayment[] $offline_fees_payments
 *
 * @package App\Models
 */
class StudentFeesMaster extends Model
{
	protected $table = 'student_fees_master';
	public $timestamps = false;

	protected $casts = [
		'is_system' => 'int',
		'student_session_id' => 'int',
		'fee_session_group_id' => 'int',
		'fee_head_course_id' => 'int',
		'amount' => 'float'
	];

	protected $fillable = [
		'is_system',
		'student_session_id',
		'fee_session_group_id',
		'fee_head_course_id',
		'amount',
		'is_active'
	];

	public function offline_fees_payments()
	{
		return $this->hasMany(OfflineFeesPayment::class);
	}
}
