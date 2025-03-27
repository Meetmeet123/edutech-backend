<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubmitAssignment
 * 
 * @property int $id
 * @property int $homework_id
 * @property int $student_id
 * @property string $message
 * @property string $docs
 * @property string|null $file_name
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class SubmitAssignment extends Model
{
	protected $table = 'submit_assignment';
	public $timestamps = false;

	protected $casts = [
		'homework_id' => 'int',
		'student_id' => 'int'
	];

	protected $fillable = [
		'homework_id',
		'student_id',
		'message',
		'docs',
		'file_name'
	];
}
