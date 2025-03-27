<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamHallticket
 * 
 * @property int $id
 * @property int|null $exam_id
 * @property int|null $class_id
 * @property int|null $section_id
 * @property int|null $student_id
 * @property int|null $student_session_id
 * @property int|null $examhallticket_type_id
 * @property string|null $date
 * @property int|null $status
 * @property string|null $remark
 * @property Carbon $created_ts
 * @property Carbon|null $updated_ts
 * @property int|null $updated_by
 *
 * @package App\Models
 */
class ExamHallticket extends Model
{
	protected $table = 'exam_hallticket';
	public $timestamps = false;

	protected $casts = [
		'exam_id' => 'int',
		'class_id' => 'int',
		'section_id' => 'int',
		'student_id' => 'int',
		'student_session_id' => 'int',
		'examhallticket_type_id' => 'int',
		'status' => 'int',
		'created_ts' => 'datetime',
		'updated_ts' => 'datetime',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'exam_id',
		'class_id',
		'section_id',
		'student_id',
		'student_session_id',
		'examhallticket_type_id',
		'date',
		'status',
		'remark',
		'created_ts',
		'updated_ts',
		'updated_by'
	];
}
