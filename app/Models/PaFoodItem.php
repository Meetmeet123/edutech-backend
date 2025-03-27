<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaFoodItem
 * 
 * @property int $fiid
 * @property string $name
 * @property string $ingredients
 * @property string $prep_procedure
 * @property string $description
 * @property int $status
 * @property Carbon|null $updated_ts
 * @property int|null $created_by
 * @property Carbon $created_ts
 *
 * @package App\Models
 */
class PaFoodItem extends Model
{
	protected $table = 'pa_food_item';
	protected $primaryKey = 'fiid';
	public $timestamps = false;

	protected $casts = [
		'status' => 'int',
		'updated_ts' => 'datetime',
		'created_by' => 'int',
		'created_ts' => 'datetime'
	];

	protected $fillable = [
		'name',
		'ingredients',
		'prep_procedure',
		'description',
		'status',
		'updated_ts',
		'created_by',
		'created_ts'
	];
}
