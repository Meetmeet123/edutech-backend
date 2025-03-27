<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AlumniStudent
 * 
 * @property int $id
 * @property string $current_email
 * @property string $current_phone
 * @property string $occupation
 * @property string $address
 * @property int $student_id
 * @property string $photo
 * @property Carbon $created_at
 * 
 * @property Student $student
 *
 * @package App\Models
 */
class AlumniStudent extends Model
{
	protected $table = 'alumni_students';
	public $timestamps = false;

	protected $casts = [
		'student_id' => 'int'
	];

	protected $fillable = [
		'current_email',
		'current_phone',
		'occupation',
		'address',
		'student_id',
		'photo'
	];

	public function student()
	{
		return $this->belongsTo(Student::class);
	}
}
