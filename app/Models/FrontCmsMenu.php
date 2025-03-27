<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FrontCmsMenu
 * 
 * @property int $id
 * @property string|null $menu
 * @property string|null $slug
 * @property string|null $description
 * @property int $open_new_tab
 * @property string $ext_url
 * @property string $ext_url_link
 * @property int $publish
 * @property string $content_type
 * @property string|null $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class FrontCmsMenu extends Model
{
	protected $table = 'front_cms_menus';
	public $timestamps = false;

	protected $casts = [
		'open_new_tab' => 'int',
		'publish' => 'int'
	];

	protected $fillable = [
		'menu',
		'slug',
		'description',
		'open_new_tab',
		'ext_url',
		'ext_url_link',
		'publish',
		'content_type',
		'is_active'
	];
}
