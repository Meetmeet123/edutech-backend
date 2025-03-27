<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Topic
 * 
 * @property int $id
 * @property int $session_id
 * @property int $lesson_id
 * @property string $name
 * @property int $status
 * @property Carbon $complete_date
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Topic extends Model
{
	protected $table = 'topic';
	public $timestamps = false;

	protected $casts = [
		'session_id' => 'int',
		'lesson_id' => 'int',
		'status' => 'int',
		'complete_date' => 'datetime'
	];

	protected $fillable = [
		'session_id',
		'lesson_id',
		'name',
		'status',
		'complete_date'
	];
}
