<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Hostel
 * 
 * @property int $id
 * @property string|null $hostel_name
 * @property string|null $type
 * @property string|null $address
 * @property int|null $intake
 * @property string|null $description
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Hostel extends Model
{
	protected $table = 'hostel';

	protected $casts = [
		'intake' => 'int'
	];

	protected $fillable = [
		'hostel_name',
		'type',
		'address',
		'intake',
		'description',
		'is_active'
	];
}
