<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Class
 * 
 * @property int $id
 * @property string|null $class
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $name
 * @property int|null $course_id
 * @property string|null $numeric_name
 * @property string|null $monthly_tution_fee
 * @property string|null $admission_fee
 * @property string|null $exam_fee
 * @property string|null $certificate_fee
 * @property string|null $note
 * @property string|null $status
 * @property Carbon|null $modified_at
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @package App\Models
 */
class Classes extends Model
{
	protected $table = 'classes';

	protected $casts = [
		'course_id' => 'int',
		'modified_at' => 'datetime',
		'created_by' => 'int',
		'modified_by' => 'int'
	];

	protected $fillable = [
		'class',
		'is_active',
		'name',
		'course_id',
		'numeric_name',
		'monthly_tution_fee',
		'admission_fee',
		'exam_fee',
		'certificate_fee',
		'note',
		'status',
		'modified_at',
		'created_by',
		'modified_by'
	];
}
