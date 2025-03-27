<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamGroupClassBatchExamStudent
 * 
 * @property int $id
 * @property int $exam_group_class_batch_exam_id
 * @property int $student_id
 * @property int $student_session_id
 * @property int $roll_no
 * @property string|null $exam_seat_no
 * @property string|null $teacher_remark
 * @property int|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ExamGroupClassBatchExam $exam_group_class_batch_exam
 * @property Student $student
 * @property StudentSession $student_session
 * @property Collection|ExamGroupExamResult[] $exam_group_exam_results
 *
 * @package App\Models
 */
class ExamGroupClassBatchExamStudent extends Model
{
	protected $table = 'exam_group_class_batch_exam_students';

	protected $casts = [
		'exam_group_class_batch_exam_id' => 'int',
		'student_id' => 'int',
		'student_session_id' => 'int',
		'roll_no' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'exam_group_class_batch_exam_id',
		'student_id',
		'student_session_id',
		'roll_no',
		'exam_seat_no',
		'teacher_remark',
		'is_active'
	];

	public function exam_group_class_batch_exam()
	{
		return $this->belongsTo(ExamGroupClassBatchExam::class);
	}

	public function student()
	{
		return $this->belongsTo(Student::class);
	}

	public function student_session()
	{
		return $this->belongsTo(StudentSession::class);
	}

	public function exam_group_exam_results()
	{
		return $this->hasMany(ExamGroupExamResult::class);
	}
}
