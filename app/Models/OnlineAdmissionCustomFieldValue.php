<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OnlineAdmissionCustomFieldValue
 * 
 * @property int $id
 * @property int|null $belong_table_id
 * @property int|null $custom_field_id
 * @property string $field_value
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CustomField|null $custom_field
 *
 * @package App\Models
 */
class OnlineAdmissionCustomFieldValue extends Model
{
	protected $table = 'online_admission_custom_field_value';

	protected $casts = [
		'belong_table_id' => 'int',
		'custom_field_id' => 'int'
	];

	protected $fillable = [
		'belong_table_id',
		'custom_field_id',
		'field_value'
	];

	public function custom_field()
	{
		return $this->belongsTo(CustomField::class);
	}
}
