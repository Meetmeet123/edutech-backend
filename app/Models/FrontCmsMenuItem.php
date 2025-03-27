<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FrontCmsMenuItem
 * 
 * @property int $id
 * @property int $menu_id
 * @property string|null $menu
 * @property int $page_id
 * @property int $parent_id
 * @property string|null $ext_url
 * @property int|null $open_new_tab
 * @property string|null $ext_url_link
 * @property string|null $slug
 * @property int|null $weight
 * @property int $publish
 * @property string|null $description
 * @property string|null $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class FrontCmsMenuItem extends Model
{
	protected $table = 'front_cms_menu_items';
	public $timestamps = false;

	protected $casts = [
		'menu_id' => 'int',
		'page_id' => 'int',
		'parent_id' => 'int',
		'open_new_tab' => 'int',
		'weight' => 'int',
		'publish' => 'int'
	];

	protected $fillable = [
		'menu_id',
		'menu',
		'page_id',
		'parent_id',
		'ext_url',
		'open_new_tab',
		'ext_url_link',
		'slug',
		'weight',
		'publish',
		'description',
		'is_active'
	];
}
