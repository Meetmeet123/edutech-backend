<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContentFor
 * 
 * @property int $id
 * @property string|null $role
 * @property int|null $content_id
 * @property int|null $user_id
 * @property Carbon $created_at
 * 
 * @property Content|null $content
 * @property User|null $user
 *
 * @package App\Models
 */
class ContentFor extends Model
{
	protected $table = 'content_for';
	public $timestamps = false;

	protected $casts = [
		'content_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'role',
		'content_id',
		'user_id'
	];

	public function content()
	{
		return $this->belongsTo(Content::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
