<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamClasswiseSubjectsMark
 * 
 * @property int $id
 * @property int|null $class_id
 * @property int|null $subject_id
 * @property int|null $subject_mark_type
 * @property int|null $max_mark
 * @property int|null $min_mark
 * @property int|null $aakarik_mark
 * @property int|null $sankalit_mark
 * @property string|null $description
 * @property int|null $status
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ExamClasswiseSubjectsMark extends Model
{
	protected $table = 'exam_classwise_subjects_mark';

	protected $casts = [
		'class_id' => 'int',
		'subject_id' => 'int',
		'subject_mark_type' => 'int',
		'max_mark' => 'int',
		'min_mark' => 'int',
		'aakarik_mark' => 'int',
		'sankalit_mark' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'class_id',
		'subject_id',
		'subject_mark_type',
		'max_mark',
		'min_mark',
		'aakarik_mark',
		'sankalit_mark',
		'description',
		'status'
	];
}
