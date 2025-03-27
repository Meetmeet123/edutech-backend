<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VideoTutorial
 * 
 * @property int $id
 * @property string $title
 * @property string|null $vid_title
 * @property string $description
 * @property string|null $thumb_path
 * @property string|null $dir_path
 * @property string $img_name
 * @property string $thumb_name
 * @property string $video_link
 * @property int $created_by
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class VideoTutorial extends Model
{
	protected $table = 'video_tutorial';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int'
	];

	protected $fillable = [
		'title',
		'vid_title',
		'description',
		'thumb_path',
		'dir_path',
		'img_name',
		'thumb_name',
		'video_link',
		'created_by'
	];
}
