<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SendNotification
 * 
 * @property int $id
 * @property string|null $title
 * @property Carbon|null $publish_date
 * @property Carbon|null $date
 * @property string|null $message
 * @property string $visible_student
 * @property string $visible_staff
 * @property string $visible_parent
 * @property string|null $created_by
 * @property int|null $created_id
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|NotificationRole[] $notification_roles
 *
 * @package App\Models
 */
class SendNotification extends Model
{
	protected $table = 'send_notification';

	protected $casts = [
		'publish_date' => 'datetime',
		'date' => 'datetime',
		'created_id' => 'int'
	];

	protected $fillable = [
		'title',
		'publish_date',
		'date',
		'message',
		'visible_student',
		'visible_staff',
		'visible_parent',
		'created_by',
		'created_id',
		'is_active'
	];

	public function notification_roles()
	{
		return $this->hasMany(NotificationRole::class);
	}
}
