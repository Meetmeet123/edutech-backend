<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamGroupClassBatchExamSubject
 * 
 * @property int $id
 * @property int|null $exam_group_class_batch_exams_id
 * @property int $subject_id
 * @property Carbon $date_from
 * @property Carbon $time_from
 * @property string $duration
 * @property string|null $room_no
 * @property int|null $mark_entry_type
 * @property float|null $max_marks
 * @property float|null $min_marks
 * @property float|null $credit_hours
 * @property Carbon|null $date_to
 * @property int|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ExamGroupClassBatchExam|null $exam_group_class_batch_exam
 * @property Subject $subject
 * @property Collection|ExamGroupExamResult[] $exam_group_exam_results
 *
 * @package App\Models
 */
class ExamGroupClassBatchExamSubject extends Model
{
	protected $table = 'exam_group_class_batch_exam_subjects';

	protected $casts = [
		'exam_group_class_batch_exams_id' => 'int',
		'subject_id' => 'int',
		'date_from' => 'datetime',
		'time_from' => 'datetime',
		'mark_entry_type' => 'int',
		'max_marks' => 'float',
		'min_marks' => 'float',
		'credit_hours' => 'float',
		'date_to' => 'datetime',
		'is_active' => 'int'
	];

	protected $fillable = [
		'exam_group_class_batch_exams_id',
		'subject_id',
		'date_from',
		'time_from',
		'duration',
		'room_no',
		'mark_entry_type',
		'max_marks',
		'min_marks',
		'credit_hours',
		'date_to',
		'is_active'
	];

	public function exam_group_class_batch_exam()
	{
		return $this->belongsTo(ExamGroupClassBatchExam::class, 'exam_group_class_batch_exams_id');
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}

	public function exam_group_exam_results()
	{
		return $this->hasMany(ExamGroupExamResult::class);
	}
}
