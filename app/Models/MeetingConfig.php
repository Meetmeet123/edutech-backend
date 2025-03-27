<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MeetingConfig
 * 
 * @property int $id
 * @property string|null $type
 * @property string|null $name
 * @property string|null $api_id
 * @property string|null $authkey
 * @property string|null $senderid
 * @property string|null $contact
 * @property string|null $username
 * @property string|null $url
 * @property string|null $password
 * @property string|null $is_active
 * @property int|null $is_online
 * @property string|null $meetdate
 * @property string|null $meettime
 * @property string|null $note
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $meet_attendee
 * @property int|null $std_class_id
 * @property string|null $std_sec_id
 * @property string|null $meet_excludes
 * @property int|null $session_id
 * @property int|null $created_by
 *
 * @package App\Models
 */
class MeetingConfig extends Model
{
	protected $table = 'meeting_config';

	protected $casts = [
		'is_online' => 'int',
		'std_class_id' => 'int',
		'session_id' => 'int',
		'created_by' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'type',
		'name',
		'api_id',
		'authkey',
		'senderid',
		'contact',
		'username',
		'url',
		'password',
		'is_active',
		'is_online',
		'meetdate',
		'meettime',
		'note',
		'meet_attendee',
		'std_class_id',
		'std_sec_id',
		'meet_excludes',
		'session_id',
		'created_by'
	];
}
