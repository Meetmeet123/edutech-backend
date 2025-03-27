<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EducationSection
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $status
 * @property Carbon $created_ts
 * @property Carbon|null $updated_ts
 *
 * @package App\Models
 */
class EducationSection extends Model
{
	protected $table = 'education_section';
	public $timestamps = false;

	protected $casts = [
		'status' => 'int',
		'created_ts' => 'datetime',
		'updated_ts' => 'datetime'
	];

	protected $fillable = [
		'name',
		'description',
		'status',
		'created_ts',
		'updated_ts'
	];
}
