<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamGroup
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $exam_type
 * @property string|null $description
 * @property int|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ExamGroupClassBatchExam[] $exam_group_class_batch_exams
 * @property Collection|ExamGroupExamConnection[] $exam_group_exam_connections
 * @property Collection|Student[] $students
 *
 * @package App\Models
 */
class ExamGroup extends Model
{
	protected $table = 'exam_groups';

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'name',
		'exam_type',
		'description',
		'is_active'
	];

	public function exam_group_class_batch_exams()
	{
		return $this->hasMany(ExamGroupClassBatchExam::class);
	}

	public function exam_group_exam_connections()
	{
		return $this->hasMany(ExamGroupExamConnection::class);
	}

	public function students()
	{
		return $this->belongsToMany(Student::class, 'exam_group_students')
					->withPivot('id', 'student_session_id', 'is_active')
					->withTimestamps();
	}
}
