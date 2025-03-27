<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OnlineExamsQuestion
 * 
 * @property int $id
 * @property int $question_id
 * @property int $onlineexam_id
 * @property int|null $subject_id
 * @property int $session_id
 * @property float $marks
 * @property float $neg_marks
 * @property int $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class OnlineExamsQuestion extends Model
{
	protected $table = 'online_exams_questions';

	protected $casts = [
		'question_id' => 'int',
		'onlineexam_id' => 'int',
		'subject_id' => 'int',
		'session_id' => 'int',
		'marks' => 'float',
		'neg_marks' => 'float',
		'is_active' => 'int'
	];

	protected $fillable = [
		'question_id',
		'onlineexam_id',
		'subject_id',
		'session_id',
		'marks',
		'neg_marks',
		'is_active'
	];
}
