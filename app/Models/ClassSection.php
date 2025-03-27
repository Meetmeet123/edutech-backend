<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ClassSection
 * 
 * @property int $id
 * @property int|null $class_id
 * @property int|null $section_id
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ClassSectionTime[] $class_section_times
 * @property Collection|OnlineAdmission[] $online_admissions
 *
 * @package App\Models
 */
class ClassSection extends Model
{
	protected $table = 'class_sections';

	protected $casts = [
		'class_id' => 'int',
		'section_id' => 'int'
	];

	protected $fillable = [
		'class_id',
		'section_id',
		'is_active'
	];

	public function class_section_times()
	{
		return $this->hasMany(ClassSectionTime::class);
	}

	public function online_admissions()
	{
		return $this->hasMany(OnlineAdmission::class);
	}

	
}
