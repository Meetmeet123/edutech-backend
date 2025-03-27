<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StaffLeaveRequest
 * 
 * @property int $id
 * @property int $staff_id
 * @property int $leave_type_id
 * @property Carbon $leave_from
 * @property Carbon $leave_to
 * @property int $leave_days
 * @property string|null $half_leave_status
 * @property string $employee_remark
 * @property string $admin_remark
 * @property string $status
 * @property string $applied_by
 * @property string $document_file
 * @property Carbon $date
 *
 * @package App\Models
 */
class StaffLeaveRequest extends Model
{
	protected $table = 'staff_leave_request';
	public $timestamps = false;

	protected $casts = [
		'staff_id' => 'int',
		'leave_type_id' => 'int',
		'leave_from' => 'datetime',
		'leave_to' => 'datetime',
		'leave_days' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'staff_id',
		'leave_type_id',
		'leave_from',
		'leave_to',
		'leave_days',
		'half_leave_status',
		'employee_remark',
		'admin_remark',
		'status',
		'applied_by',
		'document_file',
		'date'
	];
}
