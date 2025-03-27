<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VoucherDetail
 * 
 * @property int $id
 * @property string $voucher_name
 * @property int|null $inc_head_id
 * @property string $voucher_date
 * @property string|null $description
 * @property string $voucher_amount
 * @property string $voucher_no
 * @property string $voucher_type
 * @property string $ac_no
 * @property string $file_no
 * @property string $address
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class VoucherDetail extends Model
{
	protected $table = 'voucher_details';
	public $timestamps = false;

	protected $casts = [
		'inc_head_id' => 'int'
	];

	protected $fillable = [
		'voucher_name',
		'inc_head_id',
		'voucher_date',
		'description',
		'voucher_amount',
		'voucher_no',
		'voucher_type',
		'ac_no',
		'file_no',
		'address'
	];
}
