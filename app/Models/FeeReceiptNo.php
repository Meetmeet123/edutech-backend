<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FeeReceiptNo
 * 
 * @property int $id
 * @property int $payment
 *
 * @package App\Models
 */
class FeeReceiptNo extends Model
{
	protected $table = 'fee_receipt_no';
	public $timestamps = false;

	protected $casts = [
		'payment' => 'int'
	];

	protected $fillable = [
		'payment'
	];
}
