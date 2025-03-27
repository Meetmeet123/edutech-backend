<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RolesPermission
 * 
 * @property int $id
 * @property int|null $role_id
 * @property int|null $perm_cat_id
 * @property int|null $can_view
 * @property int|null $can_add
 * @property int|null $can_edit
 * @property int|null $can_delete
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class RolesPermission extends Model
{
	protected $table = 'roles_permissions';
	public $timestamps = false;

	protected $casts = [
		'role_id' => 'int',
		'perm_cat_id' => 'int',
		'can_view' => 'int',
		'can_add' => 'int',
		'can_edit' => 'int',
		'can_delete' => 'int'
	];

	protected $fillable = [
		'role_id',
		'perm_cat_id',
		'can_view',
		'can_add',
		'can_edit',
		'can_delete'
	];
}
