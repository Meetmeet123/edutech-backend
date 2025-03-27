<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MiddaymealSetting
 * 
 * @property int $id
 * @property string $per_student_primary_amount
 * @property string $per_student_secondary_amount
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class MiddaymealSetting extends Model
{
	protected $table = 'middaymeal_settings';
	public $timestamps = false;

	protected $fillable = [
		'per_student_primary_amount',
		'per_student_secondary_amount'
	];
}
