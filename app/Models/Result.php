<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Result
 * 
 * @property int $id
 * @property int $exam_id
 * @property int $class_id
 * @property int $section_id
 * @property int $academic_year_id
 * @property int $student_id
 * @property float $avg_grade_point
 * @property int $exam_total_mark
 * @property int $obtain_total_mark
 * @property string|null $remark
 * @property bool $status
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property int $created_by
 * @property int $modified_by
 *
 * @package App\Models
 */
class Result extends Model
{
	protected $table = 'results';
	public $timestamps = false;

	protected $casts = [
		'exam_id' => 'int',
		'class_id' => 'int',
		'section_id' => 'int',
		'academic_year_id' => 'int',
		'student_id' => 'int',
		'avg_grade_point' => 'float',
		'exam_total_mark' => 'int',
		'obtain_total_mark' => 'int',
		'status' => 'bool',
		'modified_at' => 'datetime',
		'created_by' => 'int',
		'modified_by' => 'int'
	];

	protected $fillable = [
		'exam_id',
		'class_id',
		'section_id',
		'academic_year_id',
		'student_id',
		'avg_grade_point',
		'exam_total_mark',
		'obtain_total_mark',
		'remark',
		'status',
		'modified_at',
		'created_by',
		'modified_by'
	];
}
