<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property int $user_id
 * @property string|null $username
 * @property string|null $password
 * @property string $childs
 * @property string $role
 * @property string $verification_code
 * @property int $lang_id
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ContentFor[] $content_fors
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'user_id' => 'int',
		'lang_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'user_id',
		'username',
		'password',
		'childs',
		'role',
		'verification_code',
		'lang_id',
		'is_active'
	];

	public function content_fors()
	{
		return $this->hasMany(ContentFor::class);
	}
}
