<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lesson
 * 
 * @property int $id
 * @property int $session_id
 * @property int $subject_group_subject_id
 * @property int $subject_group_class_sections_id
 * @property string $name
 * @property Carbon $created_at
 * 
 * @property Session $session
 * @property SubjectGroupSubject $subject_group_subject
 * @property SubjectGroupClassSection $subject_group_class_section
 *
 * @package App\Models
 */
class Lesson extends Model
{
	protected $table = 'lesson';
	public $timestamps = false;

	protected $casts = [
		'session_id' => 'int',
		'subject_group_subject_id' => 'int',
		'subject_group_class_sections_id' => 'int'
	];

	protected $fillable = [
		'session_id',
		'subject_group_subject_id',
		'subject_group_class_sections_id',
		'name'
	];

	public function session()
	{
		return $this->belongsTo(Session::class);
	}

	public function subject_group_subject()
	{
		return $this->belongsTo(SubjectGroupSubject::class);
	}

	public function subject_group_class_section()
	{
		return $this->belongsTo(SubjectGroupClassSection::class, 'subject_group_class_sections_id');
	}
}
