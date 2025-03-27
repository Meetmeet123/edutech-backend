<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TransportRoute
 * 
 * @property int $id
 * @property string|null $route_title
 * @property int|null $no_of_vehicle
 * @property float|null $fare
 * @property string|null $note
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TransportRoute extends Model
{
	protected $table = 'transport_route';

	protected $casts = [
		'no_of_vehicle' => 'int',
		'fare' => 'float'
	];

	protected $fillable = [
		'route_title',
		'no_of_vehicle',
		'fare',
		'note',
		'is_active'
	];
}
