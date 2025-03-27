<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Grade
 * 
 * @property int $id
 * @property string|null $exam_type
 * @property string|null $name
 * @property float|null $point
 * @property float|null $mark_from
 * @property float|null $mark_upto
 * @property string|null $description
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property float|null $mark_to
 * @property string|null $note
 * @property int|null $status
 * @property Carbon|null $modified_at
 * @property int|null $created_by
 * @property int|null $modified_by
 *
 * @package App\Models
 */
class Grade extends Model
{
	protected $table = 'grades';

	protected $casts = [
		'point' => 'float',
		'mark_from' => 'float',
		'mark_upto' => 'float',
		'mark_to' => 'float',
		'status' => 'int',
		'modified_at' => 'datetime',
		'created_by' => 'int',
		'modified_by' => 'int'
	];

	protected $fillable = [
		'exam_type',
		'name',
		'point',
		'mark_from',
		'mark_upto',
		'description',
		'is_active',
		'mark_to',
		'note',
		'status',
		'modified_at',
		'created_by',
		'modified_by'
	];
}
