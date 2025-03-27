<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OnlineexamQuestion
 * 
 * @property int $id
 * @property int|null $question_id
 * @property int|null $onlineexam_id
 * @property int|null $session_id
 * @property float $marks
 * @property float|null $neg_marks
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Onlineexam|null $onlineexam
 * @property Question|null $question
 * @property Session|null $session
 * @property Collection|OnlineexamStudentResult[] $onlineexam_student_results
 *
 * @package App\Models
 */
class OnlineexamQuestion extends Model
{
	protected $table = 'onlineexam_questions';

	protected $casts = [
		'question_id' => 'int',
		'onlineexam_id' => 'int',
		'session_id' => 'int',
		'marks' => 'float',
		'neg_marks' => 'float'
	];

	protected $fillable = [
		'question_id',
		'onlineexam_id',
		'session_id',
		'marks',
		'neg_marks',
		'is_active'
	];

	public function onlineexam()
	{
		return $this->belongsTo(Onlineexam::class);
	}

	public function question()
	{
		return $this->belongsTo(Question::class);
	}

	public function session()
	{
		return $this->belongsTo(Session::class);
	}

	public function onlineexam_student_results()
	{
		return $this->hasMany(OnlineexamStudentResult::class);
	}
}
