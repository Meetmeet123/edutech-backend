<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VehicleRoute
 * 
 * @property int $id
 * @property int|null $route_id
 * @property int|null $vehicle_id
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class VehicleRoute extends Model
{
	protected $table = 'vehicle_routes';
	public $timestamps = false;

	protected $casts = [
		'route_id' => 'int',
		'vehicle_id' => 'int'
	];

	protected $fillable = [
		'route_id',
		'vehicle_id'
	];
}
