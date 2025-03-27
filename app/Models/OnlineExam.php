<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Onlineexam
 * 
 * @property int $id
 * @property string|null $exam
 * @property int $attempt
 * @property Carbon|null $exam_from
 * @property Carbon|null $exam_to
 * @property int $is_quiz
 * @property Carbon|null $auto_publish_date
 * @property Carbon|null $time_from
 * @property Carbon|null $time_to
 * @property Carbon $duration
 * @property float $passing_percentage
 * @property string|null $description
 * @property int|null $session_id
 * @property int $publish_result
 * @property string|null $is_active
 * @property int $is_marks_display
 * @property int $is_neg_marking
 * @property int $is_random_question
 * @property int $is_rank_generated
 * @property int $publish_exam_notification
 * @property int $publish_result_notification
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Session|null $session
 * @property Collection|Question[] $questions
 * @property Collection|OnlineexamStudent[] $onlineexam_students
 *
 * @package App\Models
 */
class Onlineexam extends Model
{
	protected $table = 'onlineexam';

	protected $casts = [
		'attempt' => 'int',
		'exam_from' => 'datetime',
		'exam_to' => 'datetime',
		'is_quiz' => 'int',
		'auto_publish_date' => 'datetime',
		'time_from' => 'datetime',
		'time_to' => 'datetime',
		'duration' => 'datetime',
		'passing_percentage' => 'float',
		'session_id' => 'int',
		'publish_result' => 'int',
		'is_marks_display' => 'int',
		'is_neg_marking' => 'int',
		'is_random_question' => 'int',
		'is_rank_generated' => 'int',
		'publish_exam_notification' => 'int',
		'publish_result_notification' => 'int'
	];

	protected $fillable = [
		'exam',
		'attempt',
		'exam_from',
		'exam_to',
		'is_quiz',
		'auto_publish_date',
		'time_from',
		'time_to',
		'duration',
		'passing_percentage',
		'description',
		'session_id',
		'publish_result',
		'is_active',
		'is_marks_display',
		'is_neg_marking',
		'is_random_question',
		'is_rank_generated',
		'publish_exam_notification',
		'publish_result_notification'
	];

	public function session()
	{
		return $this->belongsTo(Session::class);
	}

	public function questions()
	{
		return $this->belongsToMany(Question::class, 'onlineexam_questions')
					->withPivot('id', 'session_id', 'marks', 'neg_marks', 'is_active')
					->withTimestamps();
	}

	public function onlineexam_students()
	{
		return $this->hasMany(OnlineexamStudent::class);
	}
}
