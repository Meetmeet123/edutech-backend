<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NotificationRole
 * 
 * @property int $id
 * @property int|null $send_notification_id
 * @property int|null $role_id
 * @property int|null $is_active
 * @property Carbon $created_at
 * 
 * @property SendNotification|null $send_notification
 * @property Role|null $role
 *
 * @package App\Models
 */
class NotificationRole extends Model
{
	protected $table = 'notification_roles';
	public $timestamps = false;

	protected $casts = [
		'send_notification_id' => 'int',
		'role_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'send_notification_id',
		'role_id',
		'is_active'
	];

	public function send_notification()
	{
		return $this->belongsTo(SendNotification::class);
	}

	public function role()
	{
		return $this->belongsTo(Role::class);
	}
}
