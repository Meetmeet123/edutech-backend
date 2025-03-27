<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubjectGroupClassSection
 * 
 * @property int $id
 * @property int|null $subject_group_id
 * @property int|null $class_section_id
 * @property int|null $session_id
 * @property string|null $description
 * @property int|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Lesson[] $lessons
 *
 * @package App\Models
 */
class SubjectGroupClassSection extends Model
{
	protected $table = 'subject_group_class_sections';

	protected $casts = [
		'subject_group_id' => 'int',
		'class_section_id' => 'int',
		'session_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'subject_group_id',
		'class_section_id',
		'session_id',
		'description',
		'is_active'
	];

	public function lessons()
	{
		return $this->hasMany(Lesson::class, 'subject_group_class_sections_id');
	}
}
