<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Exam
 * 
 * @property int $id
 * @property string|null $name
 * @property int $sesion_id
 * @property string|null $note
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property int|null $academic_year_id
 * @property string|null $title
 * @property string|null $start_date
 * @property int|null $status
 * @property Carbon|null $modified_at
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @package App\Models
 */
class Exam extends Model
{
	protected $table = 'exams';

	protected $casts = [
		'sesion_id' => 'int',
		'academic_year_id' => 'int',
		'status' => 'int',
		'modified_at' => 'datetime',
		'created_by' => 'int',
		'modified_by' => 'int'
	];

	protected $fillable = [
		'name',
		'sesion_id',
		'note',
		'is_active',
		'academic_year_id',
		'title',
		'start_date',
		'status',
		'modified_at',
		'created_by',
		'modified_by'
	];
}
