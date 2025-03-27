<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ClassSectionTime
 * 
 * @property int $id
 * @property int|null $class_section_id
 * @property Carbon|null $time
 * @property Carbon $created_at
 * 
 * @property ClassSection|null $class_section
 *
 * @package App\Models
 */
class ClassSectionTime extends Model
{
	protected $table = 'class_section_times';
	public $timestamps = false;

	protected $casts = [
		'class_section_id' => 'int',
		'time' => 'datetime'
	];

	protected $fillable = [
		'class_section_id',
		'time'
	];

	public function class_section()
	{
		return $this->belongsTo(ClassSection::class);
	}
}
