<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LessonPlanForum
 * 
 * @property int $id
 * @property int $subject_syllabus_id
 * @property string $type
 * @property int|null $staff_id
 * @property int|null $student_id
 * @property string $message
 * @property Carbon|null $created_date
 * 
 * @property SubjectSyllabu $subject_syllabu
 * @property Student|null $student
 * @property Staff|null $staff
 *
 * @package App\Models
 */
class LessonPlanForum extends Model
{
	protected $table = 'lesson_plan_forum';
	public $timestamps = false;

	protected $casts = [
		'subject_syllabus_id' => 'int',
		'staff_id' => 'int',
		'student_id' => 'int',
		'created_date' => 'datetime'
	];

	protected $fillable = [
		'subject_syllabus_id',
		'type',
		'staff_id',
		'student_id',
		'message',
		'created_date'
	];

	public function subject_syllabu()
	{
		return $this->belongsTo(SubjectSyllabu::class, 'subject_syllabus_id');
	}

	public function student()
	{
		return $this->belongsTo(Student::class);
	}

	public function staff()
	{
		return $this->belongsTo(Staff::class);
	}
}
