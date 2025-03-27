<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Log
 * 
 * @property int $id
 * @property string|null $message
 * @property string|null $record_id
 * @property int|null $user_id
 * @property string|null $action
 * @property string|null $ip_address
 * @property string|null $platform
 * @property string|null $agent
 * @property Carbon $time
 * @property Carbon|null $created_at
 *
 * @package App\Models
 */
class Log extends Model
{
	protected $table = 'logs';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'time' => 'datetime'
	];

	protected $fillable = [
		'message',
		'record_id',
		'user_id',
		'action',
		'ip_address',
		'platform',
		'agent',
		'time'
	];
}
