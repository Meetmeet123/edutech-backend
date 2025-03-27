<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionBank
 * 
 * @property int $id
 * @property int|null $staff_id
 * @property int|null $subject_id
 * @property string $question_type
 * @property string $level
 * @property int|null $class_id
 * @property int|null $section_id
 * @property int|null $class_section_id
 * @property string|null $question
 * @property string|null $opt_a
 * @property string|null $opt_b
 * @property string|null $opt_c
 * @property string|null $opt_d
 * @property string|null $opt_e
 * @property string|null $correct
 * @property int|null $exam_id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class QuestionBank extends Model
{
	protected $table = 'question_bank';

	protected $casts = [
		'staff_id' => 'int',
		'subject_id' => 'int',
		'class_id' => 'int',
		'section_id' => 'int',
		'class_section_id' => 'int',
		'exam_id' => 'int'
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
		'correct',
		'exam_id'
	];
}
