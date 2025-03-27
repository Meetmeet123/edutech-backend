<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClassTeacher
 * 
 * @property int $id
 * @property int $class_id
 * @property int $staff_id
 * @property int $section_id
 * @property int $session_id
 *
 * @package App\Models
 */
class ClassTeacher extends Model
{
	protected $table = 'class_teacher';
	public $timestamps = false;

	protected $casts = [
		'class_id' => 'int',
		'staff_id' => 'int',
		'section_id' => 'int',
		'session_id' => 'int'
	];

	protected $fillable = [
		'class_id',
		'staff_id',
		'section_id',
		'session_id'
	];
}
