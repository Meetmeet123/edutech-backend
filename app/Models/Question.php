<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 * 
 * @property int $id
 * @property int|null $staff_id
 * @property int|null $subject_id
 * @property string $question_type
 * @property string $level
 * @property int $class_id
 * @property int $section_id
 * @property int|null $class_section_id
 * @property string|null $question
 * @property string|null $opt_a
 * @property string|null $opt_b
 * @property string|null $opt_c
 * @property string|null $opt_d
 * @property string|null $opt_e
 * @property string|null $correct
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Subject|null $subject
 * @property Collection|Onlineexam[] $onlineexams
 *
 * @package App\Models
 */
class Question extends Model
{
	protected $table = 'questions';

	protected $casts = [
		'staff_id' => 'int',
		'subject_id' => 'int',
		'class_id' => 'int',
		'section_id' => 'int',
		'class_section_id' => 'int'
	];

	protected $fillable = [
		'staff_id',
		'subject_id',
		'question_type',
		'level',
		'class_id',
		'section_id',
		'class_section_id',
		'question',
		'opt_a',
		'opt_b',
		'opt_c',
		'opt_d',
		'opt_e',
		'correct'
	];

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}

	public function onlineexams()
	{
		return $this->belongsToMany(Onlineexam::class, 'onlineexam_questions')
					->withPivot('id', 'session_id', 'marks', 'neg_marks', 'is_active')
					->withTimestamps();
	}
}
