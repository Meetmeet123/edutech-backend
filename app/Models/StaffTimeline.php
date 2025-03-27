<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StaffTimeline
 * 
 * @property int $id
 * @property int $staff_id
 * @property string $title
 * @property Carbon $timeline_date
 * @property string $description
 * @property string $document
 * @property string $status
 * @property Carbon $date
 *
 * @package App\Models
 */
class StaffTimeline extends Model
{
	protected $table = 'staff_timeline';
	public $timestamps = false;

	protected $casts = [
		'staff_id' => 'int',
		'timeline_date' => 'datetime',
		'date' => 'datetime'
	];

	protected $fillable = [
		'staff_id',
		'title',
		'timeline_date',
		'description',
		'document',
		'status',
		'date'
	];
}
