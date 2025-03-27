<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Userlog
 * 
 * @property int $id
 * @property string|null $user
 * @property string|null $role
 * @property int|null $class_section_id
 * @property string|null $ipaddress
 * @property string|null $user_agent
 * @property Carbon $login_datetime
 *
 * @package App\Models
 */
class Userlog extends Model
{
	protected $table = 'userlog';
	public $timestamps = false;

	protected $casts = [
		'class_section_id' => 'int',
		'login_datetime' => 'datetime'
	];

	protected $fillable = [
		'user',
		'role',
		'class_section_id',
		'ipaddress',
		'user_agent',
		'login_datetime'
	];
}
