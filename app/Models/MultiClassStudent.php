<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MultiClassStudent
 * 
 * @property int $id
 * @property int|null $student_id
 * @property int|null $student_session_id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Student|null $student
 * @property StudentSession|null $student_session
 *
 * @package App\Models
 */
class MultiClassStudent extends Model
{
	protected $table = 'multi_class_students';

	protected $casts = [
		'student_id' => 'int',
		'student_session_id' => 'int'
	];

	protected $fillable = [
		'student_id',
		'student_session_id'
	];

	public function student()
	{
		return $this->belongsTo(Student::class);
	}

	public function student_session()
	{
		return $this->belongsTo(StudentSession::class);
	}
}
