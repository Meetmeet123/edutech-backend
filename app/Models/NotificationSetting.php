<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NotificationSetting
 * 
 * @property int $id
 * @property string|null $type
 * @property string|null $is_mail
 * @property string|null $is_sms
 * @property int $is_notification
 * @property int $display_notification
 * @property int $display_sms
 * @property int $display_whatsapp
 * @property string $subject
 * @property string $template_id
 * @property string $template
 * @property string $variables
 * @property string|null $msg_content
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class NotificationSetting extends Model
{
	protected $table = 'notification_setting';
	public $timestamps = false;

	protected $casts = [
		'is_notification' => 'int',
		'display_notification' => 'int',
		'display_sms' => 'int',
		'display_whatsapp' => 'int'
	];

	protected $fillable = [
		'type',
		'is_mail',
		'is_sms',
		'is_notification',
		'display_notification',
		'display_sms',
		'display_whatsapp',
		'subject',
		'template_id',
		'template',
		'variables',
		'msg_content'
	];
}
