<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SchoolTimeSetting
 * 
 * @property int $id
 * @property Carbon|null $checkin_time
 * @property Carbon|null $checkout_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class SchoolTimeSetting extends Model
{
	protected $table = 'school_time_settings';

	protected $casts = [
		'checkin_time' => 'datetime',
		'checkout_time' => 'datetime'
	];

	protected $fillable = [
		'checkin_time',
		'checkout_time'
	];
}
