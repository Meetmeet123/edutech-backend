<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FrontCmsProgram
 * 
 * @property int $id
 * @property string|null $type
 * @property string|null $slug
 * @property string|null $url
 * @property string|null $title
 * @property Carbon|null $date
 * @property Carbon|null $event_start
 * @property Carbon|null $event_end
 * @property string|null $event_venue
 * @property string|null $description
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 * @property string $feature_image
 * @property Carbon $publish_date
 * @property string|null $publish
 * @property int|null $sidebar
 * @property string|null $icon_text
 * @property string|null $section_class
 * @property string|null $director_name
 * @property string|null $director_post
 * @property string|null $facebook_link
 * @property string|null $twitter_link
 * @property string|null $instagram_link
 * 
 * @property Collection|FrontCmsProgramPhoto[] $front_cms_program_photos
 *
 * @package App\Models
 */
class FrontCmsProgram extends Model
{
	protected $table = 'front_cms_programs';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'event_start' => 'datetime',
		'event_end' => 'datetime',
		'publish_date' => 'datetime',
		'sidebar' => 'int'
	];

	protected $fillable = [
		'type',
		'slug',
		'url',
		'title',
		'date',
		'event_start',
		'event_end',
		'event_venue',
		'description',
		'is_active',
		'meta_title',
		'meta_description',
		'meta_keyword',
		'feature_image',
		'publish_date',
		'publish',
		'sidebar',
		'icon_text',
		'section_class',
		'director_name',
		'director_post',
		'facebook_link',
		'twitter_link',
		'instagram_link'
	];

	public function front_cms_program_photos()
	{
		return $this->hasMany(FrontCmsProgramPhoto::class, 'program_id');
	}
}
