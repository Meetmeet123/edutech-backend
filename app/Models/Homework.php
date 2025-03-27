<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Homework
 * 
 * @property int $id
 * @property int $class_id
 * @property int $section_id
 * @property int $session_id
 * @property Carbon $homework_date
 * @property Carbon $submit_date
 * @property int $staff_id
 * @property int|null $subject_group_subject_id
 * @property int $subject_id
 * @property string|null $description
 * @property Carbon $create_date
 * @property Carbon $evaluation_date
 * @property string $document
 * @property int $created_by
 * @property int $evaluated_by
 * 
 * @property SubjectGroupSubject|null $subject_group_subject
 *
 * @package App\Models
 */
class Homework extends Model
{
	protected $table = 'homework';
	public $timestamps = false;

	protected $casts = [
		'class_id' => 'int',
		'section_id' => 'int',
		'session_id' => 'int',
		'homework_date' => 'datetime',
		'submit_date' => 'datetime',
		'staff_id' => 'int',
		'subject_group_subject_id' => 'int',
		'subject_id' => 'int',
		'create_date' => 'datetime',
		'evaluation_date' => 'datetime',
		'created_by' => 'int',
		'evaluated_by' => 'int'
	];

	protected $fillable = [
		'class_id',
		'section_id',
		'session_id',
		'homework_date',
		'submit_date',
		'staff_id',
		'subject_group_subject_id',
		'subject_id',
		'description',
		'create_date',
		'evaluation_date',
		'document',
		'created_by',
		'evaluated_by'
	];

	public function subject_group_subject()
	{
		return $this->belongsTo(SubjectGroupSubject::class);
	}
}
