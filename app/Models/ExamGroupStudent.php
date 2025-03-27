<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamGroupStudent
 * 
 * @property int $id
 * @property int|null $exam_group_id
 * @property int|null $student_id
 * @property int|null $student_session_id
 * @property int|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ExamGroup|null $exam_group
 * @property Student|null $student
 * @property Collection|ExamGroupExamResult[] $exam_group_exam_results
 *
 * @package App\Models
 */
class ExamGroupStudent extends Model
{
	protected $table = 'exam_group_students';

	protected $casts = [
		'exam_group_id' => 'int',
		'student_id' => 'int',
		'student_session_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'exam_group_id',
		'student_id',
		'student_session_id',
		'is_active'
	];

	public function exam_group()
	{
		return $this->belongsTo(ExamGroup::class);
	}

	public function student()
	{
		return $this->belongsTo(Student::class);
	}

	public function exam_group_exam_results()
	{
		return $this->hasMany(ExamGroupExamResult::class);
	}
}
