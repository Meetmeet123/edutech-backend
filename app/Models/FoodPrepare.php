<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FoodPrepare
 * 
 * @property int $id
 * @property int $food_id
 * @property string $total_p_students
 * @property string $total_p_present
 * @property string $total_p_beneficiary
 * @property string $total_s_students
 * @property string $total_s_present
 * @property string $total_s_beneficiary
 * @property string $description
 * @property string $date
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class FoodPrepare extends Model
{
	protected $table = 'food_prepare';

	protected $casts = [
		'food_id' => 'int'
	];

	protected $fillable = [
		'food_id',
		'total_p_students',
		'total_p_present',
		'total_p_beneficiary',
		'total_s_students',
		'total_s_present',
		'total_s_beneficiary',
		'description',
		'date'
	];
}
