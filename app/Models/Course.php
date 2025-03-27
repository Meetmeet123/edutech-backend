<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * 
 * @property int $id
 * @property string $course_name
 * @property string|null $course_description
 * @property string|null $course_status
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Course extends Model
{
	protected $table = 'courses';

	protected $fillable = [
		'course_name',
		'course_description',
		'course_status'
	];
}
