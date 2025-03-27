<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionCategory
 * 
 * @property int $id
 * @property int|null $perm_group_id
 * @property string|null $name
 * @property string|null $short_code
 * @property int|null $enable_view
 * @property int|null $enable_add
 * @property int|null $enable_edit
 * @property int|null $enable_delete
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class PermissionCategory extends Model
{
	protected $table = 'permission_category';
	public $timestamps = false;

	protected $casts = [
		'perm_group_id' => 'int',
		'enable_view' => 'int',
		'enable_add' => 'int',
		'enable_edit' => 'int',
		'enable_delete' => 'int'
	];

	protected $fillable = [
		'perm_group_id',
		'name',
		'short_code',
		'enable_view',
		'enable_add',
		'enable_edit',
		'enable_delete'
	];
}
