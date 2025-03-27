<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DailyAssignment
 * 
 * @property int $id
 * @property int $student_session_id
 * @property int $subject_group_subject_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $attachment
 * @property int|null $evaluated_by
 * @property Carbon|null $date
 * @property Carbon|null $evaluation_date
 * @property string $remark
 * @property Carbon $created_at
 * 
 * @property StudentSession $student_session
 * @property Staff|null $staff
 * @property SubjectGroupSubject $subject_group_subject
 *
 * @package App\Models
 */
class DailyAssignment extends Model
{
	protected $table = 'daily_assignment';
	public $timestamps = false;

	protected $casts = [
		'student_session_id' => 'int',
		'subject_group_subject_id' => 'int',
		'evaluated_by' => 'int',
		'date' => 'datetime',
		'evaluation_date' => 'datetime'
	];

	protected $fillable = [
		'student_session_id',
		'subject_group_subject_id',
		'title',
		'description',
		'attachment',
		'evaluated_by',
		'date',
		'evaluation_date',
		'remark'
	];

	public function student_session()
	{
		return $this->belongsTo(StudentSession::class);
	}

	public function staff()
	{
		return $this->belongsTo(Staff::class, 'evaluated_by');
	}

	public function subject_group_subject()
	{
		return $this->belongsTo(SubjectGroupSubject::class);
	}
}
