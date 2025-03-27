<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StaffRole
 * 
 * @property int $id
 * @property int|null $role_id
 * @property int|null $staff_id
 * @property int|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class StaffRole extends Model
{
	protected $table = 'staff_roles';

	protected $casts = [
		'role_id' => 'int',
		'staff_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'role_id',
		'staff_id',
		'is_active'
	];
}
