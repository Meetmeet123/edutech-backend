<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CompetitiveExamStudent
 * 
 * @property int $id
 * @property int $exam_id
 * @property int $student_id
 * @property int $student_session_id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CompetitiveExamStudent extends Model
{
	protected $table = 'competitive_exam_students';

	protected $casts = [
		'exam_id' => 'int',
		'student_id' => 'int',
		'student_session_id' => 'int'
	];

	protected $fillable = [
		'exam_id',
		'student_id',
		'student_session_id'
	];
}
