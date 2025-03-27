<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RoutePickupPoint
 * 
 * @property int $id
 * @property int $transport_route_id
 * @property int $pickup_point_id
 * @property float|null $fees
 * @property float|null $destination_distance
 * @property Carbon|null $pickup_time
 * @property float $order_number
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class RoutePickupPoint extends Model
{
	protected $table = 'route_pickup_point';
	public $timestamps = false;

	protected $casts = [
		'transport_route_id' => 'int',
		'pickup_point_id' => 'int',
		'fees' => 'float',
		'destination_distance' => 'float',
		'pickup_time' => 'datetime',
		'order_number' => 'float'
	];

	protected $fillable = [
		'transport_route_id',
		'pickup_point_id',
		'fees',
		'destination_distance',
		'pickup_time',
		'order_number'
	];
}
