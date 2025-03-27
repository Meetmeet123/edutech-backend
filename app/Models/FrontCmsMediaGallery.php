<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FrontCmsMediaGallery
 * 
 * @property int $id
 * @property string|null $image
 * @property string|null $thumb_path
 * @property string|null $dir_path
 * @property string|null $img_name
 * @property string|null $thumb_name
 * @property Carbon $created_at
 * @property string $file_type
 * @property string $file_size
 * @property string $vid_url
 * @property string $vid_title
 *
 * @package App\Models
 */
class FrontCmsMediaGallery extends Model
{
	protected $table = 'front_cms_media_gallery';
	public $timestamps = false;

	protected $fillable = [
		'image',
		'thumb_path',
		'dir_path',
		'img_name',
		'thumb_name',
		'file_type',
		'file_size',
		'vid_url',
		'vid_title'
	];
}
