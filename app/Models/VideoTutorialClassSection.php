<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VideoTutorialClassSection
 * 
 * @property int $id
 * @property int $video_tutorial_id
 * @property int $class_section_id
 * @property Carbon $created_date
 *
 * @package App\Models
 */
class VideoTutorialClassSection extends Model
{
	protected $table = 'video_tutorial_class_sections';
	public $timestamps = false;

	protected $casts = [
		'video_tutorial_id' => 'int',
		'class_section_id' => 'int',
		'created_date' => 'datetime'
	];

	protected $fillable = [
		'video_tutorial_id',
		'class_section_id',
		'created_date'
	];
}
