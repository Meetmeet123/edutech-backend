<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShareContentFor
 * 
 * @property int $id
 * @property string|null $group_id
 * @property int|null $student_id
 * @property int|null $user_parent_id
 * @property int|null $staff_id
 * @property int|null $class_section_id
 * @property int|null $share_content_id
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class ShareContentFor extends Model
{
	protected $table = 'share_content_for';
	public $timestamps = false;

	protected $casts = [
		'student_id' => 'int',
		'user_parent_id' => 'int',
		'staff_id' => 'int',
		'class_section_id' => 'int',
		'share_content_id' => 'int'
	];

	protected $fillable = [
		'group_id',
		'student_id',
		'user_parent_id',
		'staff_id',
		'class_section_id',
		'share_content_id'
	];
}
