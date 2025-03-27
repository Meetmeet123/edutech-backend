<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RoomType
 * 
 * @property int $id
 * @property string|null $room_type
 * @property string|null $description
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class RoomType extends Model
{
	protected $table = 'room_types';

	protected $fillable = [
		'room_type',
		'description'
	];
}
