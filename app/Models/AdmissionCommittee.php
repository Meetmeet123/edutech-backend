<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdmissionCommittee
 * 
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $course_id
 * @property int|null $fee_category_id
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property int $created_by
 *
 * @package App\Models
 */
class AdmissionCommittee extends Model
{
	protected $table = 'admission_committee';

	protected $casts = [
		'course_id' => 'int',
		'fee_category_id' => 'int',
		'status' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'title',
		'description',
		'course_id',
		'fee_category_id',
		'status',
		'created_by'
	];
}
