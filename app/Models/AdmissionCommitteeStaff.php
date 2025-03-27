<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdmissionCommitteeStaff
 * 
 * @property int $id
 * @property int $committee_id
 * @property int $staff_id
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class AdmissionCommitteeStaff extends Model
{
	protected $table = 'admission_committee_staff';
	public $timestamps = false;

	protected $casts = [
		'committee_id' => 'int',
		'staff_id' => 'int'
	];

	protected $fillable = [
		'committee_id',
		'staff_id'
	];
}
