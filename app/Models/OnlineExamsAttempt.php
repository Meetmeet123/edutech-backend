<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OnlineExamsAttempt
 * 
 * @property int $id
 * @property int $onlineexam_student_id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class OnlineExamsAttempt extends Model
{
	protected $table = 'online_exams_attempts';

	protected $casts = [
		'onlineexam_student_id' => 'int'
	];

	protected $fillable = [
		'onlineexam_student_id'
	];
}
