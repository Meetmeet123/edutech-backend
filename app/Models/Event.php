<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 * 
 * @property int $id
 * @property string $event_title
 * @property string $event_description
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property string $event_type
 * @property string $event_color
 * @property string $event_for
 * @property int $role_id
 * @property string $is_active
 *
 * @package App\Models
 */
class Event extends Model
{
	protected $table = 'events';
	public $timestamps = false;

	protected $casts = [
		'start_date' => 'datetime',
		'end_date' => 'datetime',
		'role_id' => 'int'
	];

	protected $fillable = [
		'event_title',
		'event_description',
		'start_date',
		'end_date',
		'event_type',
		'event_color',
		'event_for',
		'role_id',
		'is_active'
	];
}
