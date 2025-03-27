<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HomeworkEvaluation
 * 
 * @property int $id
 * @property int $homework_id
 * @property int $student_id
 * @property int|null $student_session_id
 * @property Carbon $date
 * @property string $status
 * @property string|null $std_hwork_remark
 * @property string|null $std_hwork_doc
 * @property string|null $std_hwork_date
 * @property string|null $std_eval_remark
 * @property string|null $std_eval_doc
 * @property string|null $std_eval_date
 *
 * @package App\Models
 */
class HomeworkEvaluation extends Model
{
	protected $table = 'homework_evaluation';
	public $timestamps = false;

	protected $casts = [
		'homework_id' => 'int',
		'student_id' => 'int',
		'student_session_id' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'homework_id',
		'student_id',
		'student_session_id',
		'date',
		'status',
		'std_hwork_remark',
		'std_hwork_doc',
		'std_hwork_date',
		'std_eval_remark',
		'std_eval_doc',
		'std_eval_date'
	];
}
