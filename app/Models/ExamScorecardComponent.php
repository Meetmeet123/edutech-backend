<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamScorecardComponent
 * 
 * @property int $id
 * @property string|null $component_name
 * @property string|null $subject_mark_grade
 * @property string|null $classes
 * @property int|null $status
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ExamScorecardComponent extends Model
{
	protected $table = 'exam_scorecard_component';

	protected $casts = [
		'status' => 'int'
	];

	protected $fillable = [
		'component_name',
		'subject_mark_grade',
		'classes',
		'status'
	];
}
