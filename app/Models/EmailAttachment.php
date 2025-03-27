<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailAttachment
 * 
 * @property int $id
 * @property int $message_id
 * @property string $directory
 * @property string $attachment
 * @property string $attachment_name
 * @property Carbon|null $created_at
 * 
 * @property Message $message
 *
 * @package App\Models
 */
class EmailAttachment extends Model
{
	protected $table = 'email_attachments';
	public $timestamps = false;

	protected $casts = [
		'message_id' => 'int'
	];

	protected $fillable = [
		'message_id',
		'directory',
		'attachment',
		'attachment_name'
	];

	public function message()
	{
		return $this->belongsTo(Message::class);
	}
}
