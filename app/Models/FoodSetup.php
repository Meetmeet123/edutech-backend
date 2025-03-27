<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FoodSetup
 * 
 * @property int $id
 * @property int $food_id
 * @property string|null $description
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class FoodSetup extends Model
{
	protected $table = 'food_setup';
	public $timestamps = false;

	protected $casts = [
		'food_id' => 'int'
	];

	protected $fillable = [
		'food_id',
		'description'
	];
}
