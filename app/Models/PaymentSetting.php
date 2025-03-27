<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentSetting
 * 
 * @property int $id
 * @property string $payment_type
 * @property string|null $api_username
 * @property string $api_secret_key
 * @property string $salt
 * @property string $api_publishable_key
 * @property string|null $api_password
 * @property string|null $api_signature
 * @property string|null $api_email
 * @property string $paypal_demo
 * @property string $account_no
 * @property string|null $is_active
 * @property int $gateway_mode
 * @property string $paytm_website
 * @property string $paytm_industrytype
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class PaymentSetting extends Model
{
	protected $table = 'payment_settings';

	protected $casts = [
		'gateway_mode' => 'int'
	];

	protected $hidden = [
		'api_secret_key',
		'api_password'
	];

	protected $fillable = [
		'payment_type',
		'api_username',
		'api_secret_key',
		'salt',
		'api_publishable_key',
		'api_password',
		'api_signature',
		'api_email',
		'paypal_demo',
		'account_no',
		'is_active',
		'gateway_mode',
		'paytm_website',
		'paytm_industrytype'
	];
}
