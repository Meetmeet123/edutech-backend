<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubjectGroup
 * 
 * @property int $id
 * @property string|null $name
 * @property int|null $course_id
 * @property string|null $description
 * @property int|null $session_id
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class SubjectGroup extends Model
{
	protected $table = 'subject_groups';
	public $timestamps = false;

	protected $casts = [
		'course_id' => 'int',
		'session_id' => 'int'
	];

	protected $fillable = [
		'name',
		'course_id',
		'description',
		'session_id'
	];
}
