<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdmissionCommitteeClass
 * 
 * @property int $id
 * @property int $class_id
 * @property int $committee_id
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class AdmissionCommitteeClass extends Model
{
	protected $table = 'admission_committee_class';
	public $timestamps = false;

	protected $casts = [
		'class_id' => 'int',
		'committee_id' => 'int'
	];

	protected $fillable = [
		'class_id',
		'committee_id'
	];
}
