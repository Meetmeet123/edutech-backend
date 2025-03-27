<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatConnection
 * 
 * @property int $id
 * @property int $chat_user_one
 * @property int $chat_user_two
 * @property string|null $ip
 * @property int|null $time
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ChatUser $chat_user
 * @property Collection|ChatMessage[] $chat_messages
 *
 * @package App\Models
 */
class ChatConnection extends Model
{
	protected $table = 'chat_connections';

	protected $casts = [
		'chat_user_one' => 'int',
		'chat_user_two' => 'int',
		'time' => 'int'
	];

	protected $fillable = [
		'chat_user_one',
		'chat_user_two',
		'ip',
		'time'
	];

	public function chat_user()
	{
		return $this->belongsTo(ChatUser::class, 'chat_user_two');
	}

	public function chat_messages()
	{
		return $this->hasMany(ChatMessage::class);
	}
}
