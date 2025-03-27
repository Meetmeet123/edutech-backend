<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentApplyleave
 * 
 * @property int $id
 * @property int $student_session_id
 * @property Carbon $from_date
 * @property Carbon $to_date
 * @property Carbon $apply_date
 * @property int $status
 * @property Carbon $created_at
 * @property string $docs
 * @property string $reason
 * @property int $approve_by
 * @property int $request_type
 *
 * @package App\Models
 */
class StudentApplyleave extends Model
{
	protected $table = 'student_applyleave';
	public $timestamps = false;

	protected $casts = [
		'student_session_id' => 'int',
		'from_date' => 'datetime',
		'to_date' => 'datetime',
		'apply_date' => 'datetime',
		'status' => 'int',
		'approve_by' => 'int',
		'request_type' => 'int'
	];

	protected $fillable = [
		'student_session_id',
		'from_date',
		'to_date',
		'apply_date',
		'status',
		'docs',
		'reason',
		'approve_by',
		'request_type'
	];
}
