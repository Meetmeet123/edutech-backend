<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamGroupClassBatchExam
 * 
 * @property int $id
 * @property string|null $exam
 * @property int $session_id
 * @property Carbon|null $date_from
 * @property Carbon|null $date_to
 * @property string|null $description
 * @property int|null $exam_group_id
 * @property int $use_exam_roll_no
 * @property int|null $is_publish
 * @property int|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ExamGroup|null $exam_group
 * @property Collection|Student[] $students
 * @property Collection|Subject[] $subjects
 * @property Collection|ExamGroupExamConnection[] $exam_group_exam_connections
 *
 * @package App\Models
 */
class ExamGroupClassBatchExam extends Model
{
	protected $table = 'exam_group_class_batch_exams';

	protected $casts = [
		'session_id' => 'int',
		'date_from' => 'datetime',
		'date_to' => 'datetime',
		'exam_group_id' => 'int',
		'use_exam_roll_no' => 'int',
		'is_publish' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'exam',
		'session_id',
		'date_from',
		'date_to',
		'description',
		'exam_group_id',
		'use_exam_roll_no',
		'is_publish',
		'is_active'
	];

	public function exam_group()
	{
		return $this->belongsTo(ExamGroup::class);
	}

	public function students()
	{
		return $this->belongsToMany(Student::class, 'exam_group_class_batch_exam_students')
					->withPivot('id', 'student_session_id', 'roll_no', 'exam_seat_no', 'teacher_remark', 'is_active')
					->withTimestamps();
	}

	public function subjects()
	{
		return $this->belongsToMany(Subject::class, 'exam_group_class_batch_exam_subjects', 'exam_group_class_batch_exams_id')
					->withPivot('id', 'date_from', 'time_from', 'duration', 'room_no', 'mark_entry_type', 'max_marks', 'min_marks', 'credit_hours', 'date_to', 'is_active')
					->withTimestamps();
	}

	public function exam_group_exam_connections()
	{
		return $this->hasMany(ExamGroupExamConnection::class, 'exam_group_class_batch_exams_id');
	}
}
