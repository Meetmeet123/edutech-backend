<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentAttendence
 * 
 * @property int $id
 * @property int|null $student_session_id
 * @property int $biometric_attendence
 * @property Carbon|null $date
 * @property int|null $attendence_type_id
 * @property string $remark
 * @property string|null $biometric_device_data
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class StudentAttendence extends Model
{
	protected $table = 'student_attendences';

	protected $casts = [
		'student_session_id' => 'int',
		'biometric_attendence' => 'int',
		'date' => 'datetime',
		'attendence_type_id' => 'int'
	];

	protected $fillable = [
		'student_session_id',
		'biometric_attendence',
		'date',
		'attendence_type_id',
		'remark',
		'biometric_device_data',
		'is_active'
	];
}
