<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FeesReminder
 * 
 * @property int $id
 * @property string|null $reminder_type
 * @property int|null $day
 * @property int|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class FeesReminder extends Model
{
	protected $table = 'fees_reminder';

	protected $casts = [
		'day' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'reminder_type',
		'day',
		'is_active'
	];
}
