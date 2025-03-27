<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mark
 * 
 * @property int $id
 * @property int $exam_id
 * @property int $class_id
 * @property int $section_id
 * @property int $subject_id
 * @property int $academic_year_id
 * @property int $student_id
 * @property int $grade_id
 * @property int $exam_mark
 * @property int $obtain_mark
 * @property string|null $remark
 * @property bool $status
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property int $created_by
 * @property int $modified_by
 *
 * @package App\Models
 */
class Mark extends Model
{
	protected $table = 'marks';
	public $timestamps = false;

	protected $casts = [
		'exam_id' => 'int',
		'class_id' => 'int',
		'section_id' => 'int',
		'subject_id' => 'int',
		'academic_year_id' => 'int',
		'student_id' => 'int',
		'grade_id' => 'int',
		'exam_mark' => 'int',
		'obtain_mark' => 'int',
		'status' => 'bool',
		'modified_at' => 'datetime',
		'created_by' => 'int',
		'modified_by' => 'int'
	];

	protected $fillable = [
		'exam_id',
		'class_id',
		'section_id',
		'subject_id',
		'academic_year_id',
		'student_id',
		'grade_id',
		'exam_mark',
		'obtain_mark',
		'remark',
		'status',
		'modified_at',
		'created_by',
		'modified_by'
	];
}
