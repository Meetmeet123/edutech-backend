<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Feemaster
 * 
 * @property int $id
 * @property int|null $session_id
 * @property int $feetype_id
 * @property int|null $class_id
 * @property float|null $amount
 * @property string|null $description
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Feemaster extends Model
{
	protected $table = 'feemasters';

	protected $casts = [
		'session_id' => 'int',
		'feetype_id' => 'int',
		'class_id' => 'int',
		'amount' => 'float'
	];

	protected $fillable = [
		'session_id',
		'feetype_id',
		'class_id',
		'amount',
		'description',
		'is_active'
	];
}
