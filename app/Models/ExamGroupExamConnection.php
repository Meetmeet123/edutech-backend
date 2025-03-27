<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamGroupExamConnection
 * 
 * @property int $id
 * @property int|null $exam_group_id
 * @property int|null $exam_group_class_batch_exams_id
 * @property float|null $exam_weightage
 * @property int|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ExamGroup|null $exam_group
 * @property ExamGroupClassBatchExam|null $exam_group_class_batch_exam
 *
 * @package App\Models
 */
class ExamGroupExamConnection extends Model
{
	protected $table = 'exam_group_exam_connections';

	protected $casts = [
		'exam_group_id' => 'int',
		'exam_group_class_batch_exams_id' => 'int',
		'exam_weightage' => 'float',
		'is_active' => 'int'
	];

	protected $fillable = [
		'exam_group_id',
		'exam_group_class_batch_exams_id',
		'exam_weightage',
		'is_active'
	];

	public function exam_group()
	{
		return $this->belongsTo(ExamGroup::class);
	}

	public function exam_group_class_batch_exam()
	{
		return $this->belongsTo(ExamGroupClassBatchExam::class, 'exam_group_class_batch_exams_id');
	}
}
