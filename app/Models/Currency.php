<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Currency
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $short_name
 * @property string|null $symbol
 * @property string $base_price
 * @property int|null $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Currency extends Model
{
	protected $table = 'currencies';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'name',
		'short_name',
		'symbol',
		'base_price',
		'is_active'
	];
}
