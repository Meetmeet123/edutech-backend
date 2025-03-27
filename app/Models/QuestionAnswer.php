<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionAnswer
 * 
 * @property int $id
 * @property int $question_id
 * @property int $option_id
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class QuestionAnswer extends Model
{
	protected $table = 'question_answers';
	public $timestamps = false;

	protected $casts = [
		'question_id' => 'int',
		'option_id' => 'int'
	];

	protected $fillable = [
		'question_id',
		'option_id'
	];
}
