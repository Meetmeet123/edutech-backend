<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HostelRoom
 * 
 * @property int $id
 * @property int|null $hostel_id
 * @property int|null $room_type_id
 * @property string|null $room_no
 * @property int|null $no_of_bed
 * @property float|null $cost_per_bed
 * @property string|null $title
 * @property string|null $description
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class HostelRoom extends Model
{
	protected $table = 'hostel_rooms';

	protected $casts = [
		'hostel_id' => 'int',
		'room_type_id' => 'int',
		'no_of_bed' => 'int',
		'cost_per_bed' => 'float'
	];

	protected $fillable = [
		'hostel_id',
		'room_type_id',
		'room_no',
		'no_of_bed',
		'cost_per_bed',
		'title',
		'description'
	];
}
