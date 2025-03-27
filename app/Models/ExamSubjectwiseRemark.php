<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamSubjectwiseRemark
 * 
 * @property int $id
 * @property int|null $subject_id
 * @property string|null $remark_name
 * @property string|null $note
 * @property string|null $lang_id
 * @property string|null $subjects
 * @property int|null $status
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ExamSubjectwiseRemark extends Model
{
	protected $table = 'exam_subjectwise_remark';

	protected $casts = [
		'subject_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'subject_id',
		'remark_name',
		'note',
		'lang_id',
		'subjects',
		'status'
	];
}
