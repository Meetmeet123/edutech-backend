<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $status
 * @property int|null $is_active
 * @property int $is_system
 * @property int $is_superadmin
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|NotificationRole[] $notification_roles
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';

	protected $casts = [
		'is_active' => 'int',
		'is_system' => 'int',
		'is_superadmin' => 'int'
	];

	protected $fillable = [
		'name',
		'slug',
		'status',
		'is_active',
		'is_system',
		'is_superadmin'
	];

	public function notification_roles()
	{
		return $this->hasMany(NotificationRole::class);
	}
}
