<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamGroupExamResult
 * 
 * @property int $id
 * @property int $exam_group_class_batch_exam_student_id
 * @property int|null $exam_group_class_batch_exam_subject_id
 * @property string|null $attendence
 * @property float|null $get_marks
 * @property string|null $get_grade
 * @property string|null $note
 * @property int|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property int|null $exam_group_student_id
 * 
 * @property ExamGroupClassBatchExamSubject|null $exam_group_class_batch_exam_subject
 * @property ExamGroupStudent|null $exam_group_student
 * @property ExamGroupClassBatchExamStudent $exam_group_class_batch_exam_student
 *
 * @package App\Models
 */
class ExamGroupExamResult extends Model
{
	protected $table = 'exam_group_exam_results';

	protected $casts = [
		'exam_group_class_batch_exam_student_id' => 'int',
		'exam_group_class_batch_exam_subject_id' => 'int',
		'get_marks' => 'float',
		'is_active' => 'int',
		'exam_group_student_id' => 'int'
	];

	protected $fillable = [
		'exam_group_class_batch_exam_student_id',
		'exam_group_class_batch_exam_subject_id',
		'attendence',
		'get_marks',
		'get_grade',
		'note',
		'is_active',
		'exam_group_student_id'
	];

	public function exam_group_class_batch_exam_subject()
	{
		return $this->belongsTo(ExamGroupClassBatchExamSubject::class);
	}

	public function exam_group_student()
	{
		return $this->belongsTo(ExamGroupStudent::class);
	}

	public function exam_group_class_batch_exam_student()
	{
		return $this->belongsTo(ExamGroupClassBatchExamStudent::class);
	}
}
