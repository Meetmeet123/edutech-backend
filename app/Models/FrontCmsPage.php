<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FrontCmsPage
 * 
 * @property int $id
 * @property string $page_type
 * @property int|null $is_homepage
 * @property string|null $title
 * @property string|null $url
 * @property string|null $type
 * @property string|null $slug
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keyword
 * @property string $feature_image
 * @property string|null $description
 * @property Carbon $publish_date
 * @property int|null $publish
 * @property int|null $sidebar
 * @property string|null $is_active
 * @property Carbon $created_at
 * 
 * @property Collection|FrontCmsPageContent[] $front_cms_page_contents
 *
 * @package App\Models
 */
class FrontCmsPage extends Model
{
	protected $table = 'front_cms_pages';
	public $timestamps = false;

	protected $casts = [
		'is_homepage' => 'int',
		'publish_date' => 'datetime',
		'publish' => 'int',
		'sidebar' => 'int'
	];

	protected $fillable = [
		'page_type',
		'is_homepage',
		'title',
		'url',
		'type',
		'slug',
		'meta_title',
		'meta_description',
		'meta_keyword',
		'feature_image',
		'description',
		'publish_date',
		'publish',
		'sidebar',
		'is_active'
	];

	public function front_cms_page_contents()
	{
		return $this->hasMany(FrontCmsPageContent::class, 'page_id');
	}
}
