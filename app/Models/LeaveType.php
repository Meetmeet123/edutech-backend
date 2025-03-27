<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LeaveType
 * 
 * @property int $id
 * @property string $type
 * @property string $is_active
 *
 * @package App\Models
 */
class LeaveType extends Model
{
	protected $table = 'leave_types';
	public $timestamps = false;

	protected $fillable = [
		'type',
		'is_active'
	];
}
