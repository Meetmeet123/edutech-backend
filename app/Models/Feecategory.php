<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Feecategory
 * 
 * @property int $id
 * @property string|null $category
 * @property int|null $cast_cat_id
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Feecategory extends Model
{
	protected $table = 'feecategory';

	protected $casts = [
		'cast_cat_id' => 'int'
	];

	protected $fillable = [
		'category',
		'cast_cat_id',
		'is_active'
	];
}
