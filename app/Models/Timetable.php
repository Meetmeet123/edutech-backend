<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Timetable
 * 
 * @property int $id
 * @property int|null $teacher_subject_id
 * @property string|null $day_name
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string|null $room_no
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Timetable extends Model
{
	protected $table = 'timetables';

	protected $casts = [
		'teacher_subject_id' => 'int'
	];

	protected $fillable = [
		'teacher_subject_id',
		'day_name',
		'start_time',
		'end_time',
		'room_no',
		'is_active'
	];
}
