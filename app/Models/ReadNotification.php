<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReadNotification
 * 
 * @property int $id
 * @property int|null $student_id
 * @property int|null $parent_id
 * @property int|null $staff_id
 * @property int|null $notification_id
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ReadNotification extends Model
{
	protected $table = 'read_notification';

	protected $casts = [
		'student_id' => 'int',
		'parent_id' => 'int',
		'staff_id' => 'int',
		'notification_id' => 'int'
	];

	protected $fillable = [
		'student_id',
		'parent_id',
		'staff_id',
		'notification_id',
		'is_active'
	];
}
