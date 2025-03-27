<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersAuthentication
 * 
 * @property int $id
 * @property int $users_id
 * @property string $token
 * @property Carbon $expired_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class UsersAuthentication extends Model
{
	protected $table = 'users_authentication';

	protected $casts = [
		'users_id' => 'int',
		'expired_at' => 'datetime'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'users_id',
		'token',
		'expired_at'
	];
}
