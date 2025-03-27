<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailTemplateAttachment
 * 
 * @property int $id
 * @property int $email_template_id
 * @property string $attachment
 * @property string $attachment_name
 *
 * @package App\Models
 */
class EmailTemplateAttachment extends Model
{
	protected $table = 'email_template_attachment';
	public $timestamps = false;

	protected $casts = [
		'email_template_id' => 'int'
	];

	protected $fillable = [
		'email_template_id',
		'attachment',
		'attachment_name'
	];
}
