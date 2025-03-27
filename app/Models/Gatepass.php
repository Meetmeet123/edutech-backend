<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gatepass
 * 
 * @property int $id
 * @property string $type
 * @property int|null $student_id
 * @property int|null $staff_id
 * @property string $start_date
 * @property string $end_date
 * @property Carbon $in_time
 * @property Carbon $out_time
 * @property string $note
 *
 * @package App\Models
 */
class Gatepass extends Model
{
	protected $table = 'gatepasses';
	public $timestamps = false;

	protected $casts = [
		'student_id' => 'int',
		'staff_id' => 'int',
		'in_time' => 'datetime',
		'out_time' => 'datetime'
	];

	protected $fillable = [
		'type',
		'student_id',
		'staff_id',
		'start_date',
		'end_date',
		'in_time',
		'out_time',
		'note'
	];
}
