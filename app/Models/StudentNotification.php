<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentNotification
 * 
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $std_id
 * @property int|null $session_id
 * @property int|null $wishBy
 * @property int $is_read
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class StudentNotification extends Model
{
	protected $table = 'student_notifications';
	public $timestamps = false;

	protected $casts = [
		'std_id' => 'int',
		'session_id' => 'int',
		'wishBy' => 'int',
		'is_read' => 'int'
	];

	protected $fillable = [
		'title',
		'description',
		'std_id',
		'session_id',
		'wishBy',
		'is_read'
	];
}
