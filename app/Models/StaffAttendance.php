<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StaffAttendance
 * 
 * @property int $id
 * @property Carbon $date
 * @property int $staff_id
 * @property int $staff_attendance_type_id
 * @property string $remark
 * @property int $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class StaffAttendance extends Model
{
	protected $table = 'staff_attendance';

	protected $casts = [
		'date' => 'datetime',
		'staff_id' => 'int',
		'staff_attendance_type_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'date',
		'staff_id',
		'staff_attendance_type_id',
		'remark',
		'is_active'
	];
}
