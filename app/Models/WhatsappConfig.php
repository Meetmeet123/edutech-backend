<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WhatsappConfig
 * 
 * @property int $id
 * @property string|null $account_sid
 * @property string|null $account_token
 * @property string|null $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class WhatsappConfig extends Model
{
	protected $table = 'whatsapp_config';
	public $timestamps = false;

	protected $hidden = [
		'account_token'
	];

	protected $fillable = [
		'account_sid',
		'account_token',
		'is_active'
	];
}
