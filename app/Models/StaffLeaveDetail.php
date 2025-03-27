<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StaffLeaveDetail
 * 
 * @property int $id
 * @property int $staff_id
 * @property int $leave_type_id
 * @property string $alloted_leave
 *
 * @package App\Models
 */
class StaffLeaveDetail extends Model
{
	protected $table = 'staff_leave_details';
	public $timestamps = false;

	protected $casts = [
		'staff_id' => 'int',
		'leave_type_id' => 'int'
	];

	protected $fillable = [
		'staff_id',
		'leave_type_id',
		'alloted_leave'
	];
}
