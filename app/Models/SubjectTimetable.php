<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubjectTimetable
 * 
 * @property int $id
 * @property string|null $day
 * @property int|null $class_id
 * @property int|null $section_id
 * @property int|null $subject_group_id
 * @property int|null $subject_group_subject_id
 * @property int|null $staff_id
 * @property string|null $time_from
 * @property string|null $time_to
 * @property Carbon|null $start_time
 * @property Carbon|null $end_time
 * @property string|null $room_no
 * @property int|null $session_id
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class SubjectTimetable extends Model
{
	protected $table = 'subject_timetable';
	public $timestamps = false;

	protected $casts = [
		'class_id' => 'int',
		'section_id' => 'int',
		'subject_group_id' => 'int',
		'subject_group_subject_id' => 'int',
		'staff_id' => 'int',
		'start_time' => 'datetime',
		'end_time' => 'datetime',
		'session_id' => 'int'
	];

	protected $fillable = [
		'day',
		'class_id',
		'section_id',
		'subject_group_id',
		'subject_group_subject_id',
		'staff_id',
		'time_from',
		'time_to',
		'start_time',
		'end_time',
		'room_no',
		'session_id'
	];
}
