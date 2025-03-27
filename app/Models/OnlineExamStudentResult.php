<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OnlineexamStudentResult
 * 
 * @property int $id
 * @property int $onlineexam_student_id
 * @property int $onlineexam_question_id
 * @property string|null $select_option
 * @property float $marks
 * @property string|null $remark
 * @property string|null $attachment_name
 * @property string|null $attachment_upload_name
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property OnlineexamStudent $onlineexam_student
 * @property OnlineexamQuestion $onlineexam_question
 *
 * @package App\Models
 */
class OnlineexamStudentResult extends Model
{
	protected $table = 'onlineexam_student_results';

	protected $casts = [
		'onlineexam_student_id' => 'int',
		'onlineexam_question_id' => 'int',
		'marks' => 'float'
	];

	protected $fillable = [
		'onlineexam_student_id',
		'onlineexam_question_id',
		'select_option',
		'marks',
		'remark',
		'attachment_name',
		'attachment_upload_name'
	];

	public function onlineexam_student()
	{
		return $this->belongsTo(OnlineexamStudent::class);
	}

	public function onlineexam_question()
	{
		return $this->belongsTo(OnlineexamQuestion::class);
	}
}
