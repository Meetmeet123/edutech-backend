<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentTimeline
 * 
 * @property int $id
 * @property int $student_id
 * @property string $title
 * @property Carbon $timeline_date
 * @property string $description
 * @property string $document
 * @property string $status
 * @property Carbon $date
 *
 * @package App\Models
 */
class StudentTimeline extends Model
{
	protected $table = 'student_timeline';
	public $timestamps = false;

	protected $casts = [
		'student_id' => 'int',
		'timeline_date' => 'datetime',
		'date' => 'datetime'
	];

	protected $fillable = [
		'student_id',
		'title',
		'timeline_date',
		'description',
		'document',
		'status',
		'date'
	];
}
