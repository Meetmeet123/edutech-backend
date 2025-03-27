<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamResult
 * 
 * @property int $id
 * @property string $attendence
 * @property int|null $exam_schedule_id
 * @property int|null $student_id
 * @property float|null $get_marks
 * @property string|null $note
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ExamResult extends Model
{
	protected $table = 'exam_results';

	protected $casts = [
		'exam_schedule_id' => 'int',
		'student_id' => 'int',
		'get_marks' => 'float'
	];

	protected $fillable = [
		'attendence',
		'exam_schedule_id',
		'student_id',
		'get_marks',
		'note',
		'is_active'
	];
}
