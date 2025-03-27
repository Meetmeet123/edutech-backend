<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AlumniEvent
 * 
 * @property int $id
 * @property string $title
 * @property string $event_for
 * @property int $session_id
 * @property string $class_id
 * @property string $section
 * @property Carbon $from_date
 * @property Carbon $to_date
 * @property string $note
 * @property string $photo
 * @property int $is_active
 * @property string $event_notification_message
 * @property int $show_onwebsite
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class AlumniEvent extends Model
{
	protected $table = 'alumni_events';
	public $timestamps = false;

	protected $casts = [
		'session_id' => 'int',
		'from_date' => 'datetime',
		'to_date' => 'datetime',
		'is_active' => 'int',
		'show_onwebsite' => 'int'
	];

	protected $fillable = [
		'title',
		'event_for',
		'session_id',
		'class_id',
		'section',
		'from_date',
		'to_date',
		'note',
		'photo',
		'is_active',
		'event_notification_message',
		'show_onwebsite'
	];
}
