<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SchoolHouse
 * 
 * @property int $id
 * @property string $house_name
 * @property string $description
 * @property string $is_active
 * @property string|null $captain_male
 * @property string|null $captain_female
 * @property string|null $captain_vice_male
 * @property string|null $captain_vice_female
 * @property string|null $supervisor
 *
 * @package App\Models
 */
class SchoolHouse extends Model
{
	protected $table = 'school_houses';
	public $timestamps = false;

	protected $fillable = [
		'house_name',
		'description',
		'is_active',
		'captain_male',
		'captain_female',
		'captain_vice_male',
		'captain_vice_female',
		'supervisor'
	];
}
