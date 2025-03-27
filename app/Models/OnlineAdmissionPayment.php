<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OnlineAdmissionPayment
 * 
 * @property int $id
 * @property int $admission_id
 * @property float $paid_amount
 * @property string $payment_mode
 * @property string $payment_type
 * @property string $transaction_id
 * @property string $note
 * @property Carbon $date
 *
 * @package App\Models
 */
class OnlineAdmissionPayment extends Model
{
	protected $table = 'online_admission_payment';
	public $timestamps = false;

	protected $casts = [
		'admission_id' => 'int',
		'paid_amount' => 'float',
		'date' => 'datetime'
	];

	protected $fillable = [
		'admission_id',
		'paid_amount',
		'payment_mode',
		'payment_type',
		'transaction_id',
		'note',
		'date'
	];
}
