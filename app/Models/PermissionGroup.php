<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionGroup
 * 
 * @property int $id
 * @property string|null $name
 * @property string $short_code
 * @property int|null $is_active
 * @property int $system
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class PermissionGroup extends Model
{
	protected $table = 'permission_group';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int',
		'system' => 'int'
	];

	protected $fillable = [
		'name',
		'short_code',
		'is_active',
		'system'
	];
}
