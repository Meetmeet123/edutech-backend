<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamClassSubjectsComponent
 * 
 * @property int $id
 * @property int|null $session_id
 * @property int|null $class_id
 * @property int|null $subject_id
 * @property int|null $mdtid
 * @property string|null $mdcid
 * @property int|null $mark
 * @property string|null $remark_language
 * @property int|null $status
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ExamClassSubjectsComponent extends Model
{
	protected $table = 'exam_class_subjects_component';

	protected $casts = [
		'session_id' => 'int',
		'class_id' => 'int',
		'subject_id' => 'int',
		'mdtid' => 'int',
		'mark' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'session_id',
		'class_id',
		'subject_id',
		'mdtid',
		'mdcid',
		'mark',
		'remark_language',
		'status'
	];
}
