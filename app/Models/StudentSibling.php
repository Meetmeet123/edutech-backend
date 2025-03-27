<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentSibling
 * 
 * @property int $id
 * @property int|null $student_id
 * @property int|null $sibling_student_id
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class StudentSibling extends Model
{
	protected $table = 'student_sibling';

	protected $casts = [
		'student_id' => 'int',
		'sibling_student_id' => 'int'
	];

	protected $fillable = [
		'student_id',
		'sibling_student_id',
		'is_active'
	];
}
