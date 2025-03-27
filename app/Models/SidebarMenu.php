<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SidebarMenu
 * 
 * @property int $id
 * @property int|null $permission_group_id
 * @property string|null $icon
 * @property string|null $menu
 * @property string|null $activate_menu
 * @property string $lang_key
 * @property int|null $system_level
 * @property int|null $level
 * @property int|null $sidebar_display
 * @property string|null $access_permissions
 * @property int $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class SidebarMenu extends Model
{
	protected $table = 'sidebar_menus';
	public $timestamps = false;

	protected $casts = [
		'permission_group_id' => 'int',
		'system_level' => 'int',
		'level' => 'int',
		'sidebar_display' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'permission_group_id',
		'icon',
		'menu',
		'activate_menu',
		'lang_key',
		'system_level',
		'level',
		'sidebar_display',
		'access_permissions',
		'is_active'
	];
}
