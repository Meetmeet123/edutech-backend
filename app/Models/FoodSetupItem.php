<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FoodSetupItem
 * 
 * @property int $id
 * @property int $food_setup_id
 * @property int $item_id
 * @property string $p_qty
 * @property string $s_qty
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class FoodSetupItem extends Model
{
	protected $table = 'food_setup_items';

	protected $casts = [
		'food_setup_id' => 'int',
		'item_id' => 'int'
	];

	protected $fillable = [
		'food_setup_id',
		'item_id',
		'p_qty',
		's_qty'
	];
}
