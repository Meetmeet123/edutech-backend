<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OnlineexamStudent
 * 
 * @property int $id
 * @property int|null $onlineexam_id
 * @property int|null $student_session_id
 * @property int $is_attempted
 * @property int|null $rank
 * @property int $quiz_attempted
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Onlineexam|null $onlineexam
 * @property StudentSession|null $student_session
 * @property Collection|OnlineexamAttempt[] $onlineexam_attempts
 * @property Collection|OnlineexamStudentResult[] $onlineexam_student_results
 *
 * @package App\Models
 */
class OnlineexamStudent extends Model
{
	protected $table = 'onlineexam_students';

	protected $casts = [
		'onlineexam_id' => 'int',
		'student_session_id' => 'int',
		'is_attempted' => 'int',
		'rank' => 'int',
		'quiz_attempted' => 'int'
	];

	protected $fillable = [
		'onlineexam_id',
		'student_session_id',
		'is_attempted',
		'rank',
		'quiz_attempted'
	];

	public function onlineexam()
	{
		return $this->belongsTo(Onlineexam::class);
	}

	public function student_session()
	{
		return $this->belongsTo(StudentSession::class);
	}

	public function onlineexam_attempts()
	{
		return $this->hasMany(OnlineexamAttempt::class);
	}

	public function onlineexam_student_results()
	{
		return $this->hasMany(OnlineexamStudentResult::class);
	}
}
