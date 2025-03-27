<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SmsConfig
 * 
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string $api_id
 * @property string $authkey
 * @property string $senderid
 * @property string|null $contact
 * @property string|null $username
 * @property string|null $url
 * @property string|null $password
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class SmsConfig extends Model
{
	protected $table = 'sms_config';

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
		'is_active'
	];
}
