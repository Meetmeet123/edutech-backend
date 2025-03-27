<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionStudent
 * 
 * @property int $id
 * @property string|null $name
 * @property string $short_code
 * @property int $system
 * @property int $student
 * @property int $parent
 * @property int $group_id
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class PermissionStudent extends Model
{
	protected $table = 'permission_student';
	public $timestamps = false;

	protected $casts = [
		'system' => 'int',
		'student' => 'int',
		'parent' => 'int',
		'group_id' => 'int'
	];

	protected $fillable = [
		'name',
		'short_code',
		'system',
		'student',
		'parent',
		'group_id'
	];
}
