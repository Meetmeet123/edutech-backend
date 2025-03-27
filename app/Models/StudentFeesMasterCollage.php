<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentFeesMasterCollage
 * 
 * @property int $id
 * @property int $student_session_id
 * @property int $fee_head_course_id
 * @property string $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class StudentFeesMasterCollage extends Model
{
	protected $table = 'student_fees_master_collage';
	public $timestamps = false;

	protected $casts = [
		'student_session_id' => 'int',
		'fee_head_course_id' => 'int'
	];

	protected $fillable = [
		'student_session_id',
		'fee_head_course_id',
		'is_active'
	];
}
