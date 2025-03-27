<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StaffAttendanceType
 * 
 * @property int $id
 * @property string $type
 * @property string $key_value
 * @property string $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class StaffAttendanceType extends Model
{
	protected $table = 'staff_attendance_type';

	protected $fillable = [
		'type',
		'key_value',
		'is_active'
	];
}
