<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TeacherSubject
 * 
 * @property int $id
 * @property int|null $session_id
 * @property int|null $classid
 * @property int|null $class_section_id
 * @property int|null $subject_id
 * @property int|null $teacher_id
 * @property string|null $description
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TeacherSubject extends Model
{
	protected $table = 'teacher_subjects';

	protected $casts = [
		'session_id' => 'int',
		'classid' => 'int',
		'class_section_id' => 'int',
		'subject_id' => 'int',
		'teacher_id' => 'int'
	];

	protected $fillable = [
		'session_id',
		'classid',
		'class_section_id',
		'subject_id',
		'teacher_id',
		'description',
		'is_active'
	];
}
