<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * 
 * @property int $ctid
 * @property string|null $name
 * @property string|null $iso_code
 * @property string|null $country_tele_code
 * @property float|null $shipping_cost
 * @property float|null $min_order_amount
 * @property int|null $shipping_cost_type
 * @property string|null $data
 * @property int|null $ctsid
 * @property Carbon $created_ts
 *
 * @package App\Models
 */
class Country extends Model
{
	protected $table = 'country';
	protected $primaryKey = 'ctid';
	public $timestamps = false;

	protected $casts = [
		'shipping_cost' => 'float',
		'min_order_amount' => 'float',
		'shipping_cost_type' => 'int',
		'ctsid' => 'int',
		'created_ts' => 'datetime'
	];

	protected $fillable = [
		'name',
		'iso_code',
		'country_tele_code',
		'shipping_cost',
		'min_order_amount',
		'shipping_cost_type',
		'data',
		'ctsid',
		'created_ts'
	];
}
