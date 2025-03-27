<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamSchedule
 * 
 * @property int $id
 * @property int $session_id
 * @property int|null $exam_id
 * @property int|null $teacher_subject_id
 * @property Carbon|null $date_of_exam
 * @property string|null $start_to
 * @property string|null $end_from
 * @property string|null $room_no
 * @property int|null $full_marks
 * @property int|null $passing_marks
 * @property string|null $note
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property int|null $std_class_id
 * @property int|null $subject_id
 * @property int|null $academic_year_id
 * @property string|null $exam_date
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string|null $examiner_id
 * @property int|null $status
 * @property Carbon|null $modified_at
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @package App\Models
 */
class ExamSchedule extends Model
{
	protected $table = 'exam_schedules';

	protected $casts = [
		'session_id' => 'int',
		'exam_id' => 'int',
		'teacher_subject_id' => 'int',
		'date_of_exam' => 'datetime',
		'full_marks' => 'int',
		'passing_marks' => 'int',
		'std_class_id' => 'int',
		'subject_id' => 'int',
		'academic_year_id' => 'int',
		'status' => 'int',
		'modified_at' => 'datetime',
		'created_by' => 'int',
		'modified_by' => 'int'
	];

	protected $fillable = [
		'session_id',
		'exam_id',
		'teacher_subject_id',
		'date_of_exam',
		'start_to',
		'end_from',
		'room_no',
		'full_marks',
		'passing_marks',
		'note',
		'is_active',
		'std_class_id',
		'subject_id',
		'academic_year_id',
		'exam_date',
		'start_time',
		'end_time',
		'examiner_id',
		'status',
		'modified_at',
		'created_by',
		'modified_by'
	];
}
