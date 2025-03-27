<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Suggestion
 * 
 * @property int $id
 * @property int $exam_id
 * @property int $class_id
 * @property int $subject_id
 * @property int $academic_year_id
 * @property string $title
 * @property string|null $note
 * @property string|null $suggestion
 * @property bool $status
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property int $created_by
 * @property int $modified_by
 *
 * @package App\Models
 */
class Suggestion extends Model
{
	protected $table = 'suggestions';
	public $timestamps = false;

	protected $casts = [
		'exam_id' => 'int',
		'class_id' => 'int',
		'subject_id' => 'int',
		'academic_year_id' => 'int',
		'status' => 'bool',
		'modified_at' => 'datetime',
		'created_by' => 'int',
		'modified_by' => 'int'
	];

	protected $fillable = [
		'exam_id',
		'class_id',
		'subject_id',
		'academic_year_id',
		'title',
		'note',
		'suggestion',
		'status',
		'modified_at',
		'created_by',
		'modified_by'
	];
}
