<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionOption
 * 
 * @property int $id
 * @property int $question_id
 * @property string $option
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class QuestionOption extends Model
{
	protected $table = 'question_options';
	public $timestamps = false;

	protected $casts = [
		'question_id' => 'int'
	];

	protected $fillable = [
		'question_id',
		'option'
	];
}
