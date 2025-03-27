<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vehicle
 * 
 * @property int $id
 * @property string|null $vehicle_no
 * @property string $vehicle_model
 * @property string|null $manufacture_year
 * @property string|null $driver_name
 * @property string $driver_licence
 * @property string|null $driver_contact
 * @property string|null $note
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Vehicle extends Model
{
	protected $table = 'vehicles';
	public $timestamps = false;

	protected $fillable = [
		'vehicle_no',
		'vehicle_model',
		'manufacture_year',
		'driver_name',
		'driver_licence',
		'driver_contact',
		'note'
	];
}
