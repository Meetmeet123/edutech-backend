<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OnlineAdmissionField
 * 
 * @property int $id
 * @property string|null $name
 * @property int|null $status
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class OnlineAdmissionField extends Model
{
	protected $table = 'online_admission_fields';
	public $timestamps = false;

	protected $casts = [
		'status' => 'int'
	];

	protected $fillable = [
		'name',
		'status'
	];
}
