<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OnlineExamSubjectDuration
 * 
 * @property int $id
 * @property int $exam_id
 * @property int $subject_id
 * @property Carbon $subject_duration
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class OnlineExamSubjectDuration extends Model
{
	protected $table = 'online_exam_subject_duration';

	protected $casts = [
		'exam_id' => 'int',
		'subject_id' => 'int',
		'subject_duration' => 'datetime'
	];

	protected $fillable = [
		'exam_id',
		'subject_id',
		'subject_duration'
	];
}
