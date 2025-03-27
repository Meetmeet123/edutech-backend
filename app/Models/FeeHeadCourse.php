<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FeeHeadCourse
 * 
 * @property int $id
 * @property int $course_id
 * @property int $class_ids
 * @property int $section_id
 * @property int $fee_cat_id
 * @property int $fee_type_id
 * @property string $amount
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class FeeHeadCourse extends Model
{
	protected $table = 'fee_head_course';

	protected $casts = [
		'course_id' => 'int',
		'class_ids' => 'int',
		'section_id' => 'int',
		'fee_cat_id' => 'int',
		'fee_type_id' => 'int'
	];

	protected $fillable = [
		'course_id',
		'class_ids',
		'section_id',
		'fee_cat_id',
		'fee_type_id',
		'amount',
		'status'
	];
}
