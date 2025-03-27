<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OnlineexamAttempt
 * 
 * @property int $id
 * @property int $onlineexam_student_id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property OnlineexamStudent $onlineexam_student
 *
 * @package App\Models
 */
class OnlineexamAttempt extends Model
{
	protected $table = 'onlineexam_attempts';

	protected $casts = [
		'onlineexam_student_id' => 'int'
	];

	protected $fillable = [
		'onlineexam_student_id'
	];

	public function onlineexam_student()
	{
		return $this->belongsTo(OnlineexamStudent::class);
	}
}
