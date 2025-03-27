<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomField
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $belong_to
 * @property string|null $type
 * @property int|null $bs_column
 * @property int|null $validation
 * @property string|null $field_values
 * @property string|null $show_table
 * @property int $visible_on_table
 * @property int|null $weight
 * @property int|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|CustomFieldValue[] $custom_field_values
 * @property Collection|OnlineAdmissionCustomFieldValue[] $online_admission_custom_field_values
 *
 * @package App\Models
 */
class CustomField extends Model
{
	protected $table = 'custom_fields';

	protected $casts = [
		'bs_column' => 'int',
		'validation' => 'int',
		'visible_on_table' => 'int',
		'weight' => 'int',
		'is_active' => 'int'
	];

	protected $fillable = [
		'name',
		'belong_to',
		'type',
		'bs_column',
		'validation',
		'field_values',
		'show_table',
		'visible_on_table',
		'weight',
		'is_active'
	];

	public function custom_field_values()
	{
		return $this->hasMany(CustomFieldValue::class);
	}

	public function online_admission_custom_field_values()
	{
		return $this->hasMany(OnlineAdmissionCustomFieldValue::class);
	}
}
