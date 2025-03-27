<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * 
 * @property int $id
 * @property string|null $title
 * @property string $template_id
 * @property string|null $message
 * @property string|null $send_mail
 * @property string|null $send_sms
 * @property string|null $is_group
 * @property string|null $is_individual
 * @property int $is_class
 * @property string|null $group_list
 * @property string|null $user_list
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|EmailAttachment[] $email_attachments
 *
 * @package App\Models
 */
class Message extends Model
{
	protected $table = 'messages';

	protected $casts = [
		'is_class' => 'int'
	];

	protected $fillable = [
		'title',
		'template_id',
		'message',
		'send_mail',
		'send_sms',
		'is_group',
		'is_individual',
		'is_class',
		'group_list',
		'user_list'
	];

	public function email_attachments()
	{
		return $this->hasMany(EmailAttachment::class);
	}
}
