<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatUser
 * 
 * @property int $id
 * @property string|null $user_type
 * @property int|null $staff_id
 * @property int|null $student_id
 * @property int|null $create_staff_id
 * @property int|null $create_student_id
 * @property int|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Staff|null $staff
 * @property Student|null $student
 * @property Collection|ChatConnection[] $chat_connections
 * @property Collection|ChatMessage[] $chat_messages
 *
 * @package App\Models
 */
class ChatUser extends Model
{
	protected $table = 'chat_users';

	protected $casts = [
		'staff_id' => 'int',
		'student_id' => 'int',
		'create_staff_id' => 'int',
		'create_student_id' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'user_type',
		'staff_id',
		'student_id',
		'create_staff_id',
		'create_student_id',
		'is_active'
	];

	public function staff()
	{
		return $this->belongsTo(Staff::class, 'create_staff_id');
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 'create_student_id');
	}

	public function chat_connections()
	{
		return $this->hasMany(ChatConnection::class, 'chat_user_two');
	}

	public function chat_messages()
	{
		return $this->hasMany(ChatMessage::class);
	}
}
