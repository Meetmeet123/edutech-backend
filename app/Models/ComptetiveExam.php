<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ComptetiveExam
 * 
 * @property int $id
 * @property string $exam_name
 * @property string $exam_date
 * @property int $class_id
 * @property int $section_id
 * @property string $exam_fees
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ComptetiveExam extends Model
{
	protected $table = 'comptetive_exams';

	protected $casts = [
		'class_id' => 'int',
		'section_id' => 'int'
	];

	protected $fillable = [
		'exam_name',
		'exam_date',
		'class_id',
		'section_id',
		'exam_fees',
		'description'
	];
}
