<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SmsTransaction
 * 
 * @property int $id
 * @property string|null $messageid
 * @property string|null $mobile_no
 * @property string|null $msg_content
 * @property string|null $userid
 * @property string|null $data
 * @property Carbon $created_ts
 * @property Carbon|null $updated_ts
 *
 * @package App\Models
 */
class SmsTransaction extends Model
{
	protected $table = 'sms_transaction';
	public $timestamps = false;

	protected $casts = [
		'created_ts' => 'datetime',
		'updated_ts' => 'datetime'
	];

	protected $fillable = [
		'messageid',
		'mobile_no',
		'msg_content',
		'userid',
		'data',
		'created_ts',
		'updated_ts'
	];
}
