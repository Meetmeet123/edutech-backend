<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AttendenceType
 * 
 * @property int $id
 * @property string|null $type
 * @property string $key_value
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class AttendenceType extends Model
{
	protected $table = 'attendence_type';

	protected $fillable = [
		'type',
		'key_value',
		'is_active'
	];
}
