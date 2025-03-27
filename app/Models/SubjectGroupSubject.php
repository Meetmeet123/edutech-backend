<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubjectGroupSubject
 * 
 * @property int $id
 * @property int|null $subject_group_id
 * @property int|null $session_id
 * @property int|null $subject_id
 * @property Carbon $created_at
 * 
 * @property Collection|DailyAssignment[] $daily_assignments
 * @property Collection|Homework[] $homework
 * @property Collection|Lesson[] $lessons
 *
 * @package App\Models
 */
class SubjectGroupSubject extends Model
{
	protected $table = 'subject_group_subjects';
	public $timestamps = false;

	protected $casts = [
		'subject_group_id' => 'int',
		'session_id' => 'int',
		'subject_id' => 'int'
	];

	protected $fillable = [
		'subject_group_id',
		'session_id',
		'subject_id'
	];

	public function daily_assignments()
	{
		return $this->hasMany(DailyAssignment::class);
	}

	public function homework()
	{
		return $this->hasMany(Homework::class);
	}

	public function lessons()
	{
		return $this->hasMany(Lesson::class);
	}
}
