<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UploadContent
 * 
 * @property int $id
 * @property int $content_type_id
 * @property string|null $image
 * @property string|null $thumb_path
 * @property string|null $dir_path
 * @property string $real_name
 * @property string|null $img_name
 * @property string|null $thumb_name
 * @property string $file_type
 * @property string $mime_type
 * @property string $file_size
 * @property string $vid_url
 * @property string $vid_title
 * @property int $upload_by
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class UploadContent extends Model
{
	protected $table = 'upload_contents';
	public $timestamps = false;

	protected $casts = [
		'content_type_id' => 'int',
		'upload_by' => 'int'
	];

	protected $fillable = [
		'content_type_id',
		'image',
		'thumb_path',
		'dir_path',
		'real_name',
		'img_name',
		'thumb_name',
		'file_type',
		'mime_type',
		'file_size',
		'vid_url',
		'vid_title',
		'upload_by'
	];
}
