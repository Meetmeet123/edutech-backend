<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatMessage
 * 
 * @property int $id
 * @property string|null $message
 * @property int $chat_user_id
 * @property string $ip
 * @property int $time
 * @property int|null $is_first
 * @property int $is_read
 * @property int $chat_connection_id
 * @property Carbon|null $created_at
 * 
 * @property ChatUser $chat_user
 * @property ChatConnection $chat_connection
 *
 * @package App\Models
 */
class ChatMessage extends Model
{
	protected $table = 'chat_messages';
	public $timestamps = false;

	protected $casts = [
		'chat_user_id' => 'int',
		'time' => 'int',
		'is_first' => 'int',
		'is_read' => 'int',
		'chat_connection_id' => 'int'
	];

	protected $fillable = [
		'message',
		'chat_user_id',
		'ip',
		'time',
		'is_first',
		'is_read',
		'chat_connection_id'
	];

	public function chat_user()
	{
		return $this->belongsTo(ChatUser::class);
	}

	public function chat_connection()
	{
		return $this->belongsTo(ChatConnection::class);
	}
}
