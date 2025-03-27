<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentSubjectAttendance
 * 
 * @property int $id
 * @property int|null $student_session_id
 * @property int|null $subject_timetable_id
 * @property int|null $attendence_type_id
 * @property Carbon|null $date
 * @property string|null $remark
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class StudentSubjectAttendance extends Model
{
	protected $table = 'student_subject_attendances';
	public $timestamps = false;

	protected $casts = [
		'student_session_id' => 'int',
		'subject_timetable_id' => 'int',
		'attendence_type_id' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'student_session_id',
		'subject_timetable_id',
		'attendence_type_id',
		'date',
		'remark'
	];
}
