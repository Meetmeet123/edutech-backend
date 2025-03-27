<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SidebarSubMenu
 * 
 * @property int $id
 * @property int|null $sidebar_menu_id
 * @property string|null $menu
 * @property string|null $key
 * @property string|null $lang_key
 * @property string|null $url
 * @property int|null $level
 * @property string|null $access_permissions
 * @property int|null $permission_group_id
 * @property string|null $activate_controller
 * @property string|null $activate_methods
 * @property string|null $addon_permission
 * @property int|null $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class SidebarSubMenu extends Model
{
	protected $table = 'sidebar_sub_menus';
	public $timestamps = false;

	protected $casts = [
		'sidebar_menu_id' => 'int',
		'level' => 'int',
		'permission_group_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'sidebar_menu_id',
		'menu',
		'key',
		'lang_key',
		'url',
		'level',
		'access_permissions',
		'permission_group_id',
		'activate_controller',
		'activate_methods',
		'addon_permission',
		'is_active'
	];
}
