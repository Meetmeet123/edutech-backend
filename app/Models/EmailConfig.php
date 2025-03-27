<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailConfig
 * 
 * @property int $id
 * @property string|null $email_type
 * @property string|null $smtp_server
 * @property string|null $smtp_port
 * @property string|null $smtp_username
 * @property string|null $smtp_password
 * @property string|null $ssl_tls
 * @property string $smtp_auth
 * @property string|null $api_key
 * @property string|null $api_secret
 * @property string|null $region
 * @property string $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class EmailConfig extends Model
{
	protected $table = 'email_config';
	public $timestamps = false;

	protected $hidden = [
		'smtp_password',
		'api_secret'
	];

	protected $fillable = [
		'email_type',
		'smtp_server',
		'smtp_port',
		'smtp_username',
		'smtp_password',
		'ssl_tls',
		'smtp_auth',
		'api_key',
		'api_secret',
		'region',
		'is_active'
	];
}
