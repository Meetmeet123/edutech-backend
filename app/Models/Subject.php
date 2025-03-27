<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subject
 * 
 * @property int $id
 * @property string|null $name
 * @property string $code
 * @property string $type
 * @property string|null $is_active
 * @property string|null $status
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ExamGroupClassBatchExam[] $exam_group_class_batch_exams
 * @property Collection|Question[] $questions
 *
 * @package App\Models
 */
class Subject extends Model
{
	protected $table = 'subjects';

	protected $fillable = [
		'name',
		'code',
		'type',
		'is_active',
		'status'
	];

	public function exam_group_class_batch_exams()
	{
		return $this->belongsToMany(ExamGroupClassBatchExam::class, 'exam_group_class_batch_exam_subjects', 'subject_id', 'exam_group_class_batch_exams_id')
					->withPivot('id', 'date_from', 'time_from', 'duration', 'room_no', 'mark_entry_type', 'max_marks', 'min_marks', 'credit_hours', 'date_to', 'is_active')
					->withTimestamps();
	}

	public function questions()
	{
		return $this->hasMany(Question::class);
	}
}
