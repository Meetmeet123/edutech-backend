<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StaffRating
 * 
 * @property int $id
 * @property int $staff_id
 * @property string $comment
 * @property int $rate
 * @property int $user_id
 * @property string $role
 * @property int $status
 * @property Carbon $entrydt
 *
 * @package App\Models
 */
class StaffRating extends Model
{
	protected $table = 'staff_rating';
	public $timestamps = false;

	protected $casts = [
		'staff_id' => 'int',
		'rate' => 'int',
		'user_id' => 'int',
		'status' => 'int',
		'entrydt' => 'datetime'
	];

	protected $fillable = [
		'staff_id',
		'comment',
		'rate',
		'user_id',
		'role',
		'status',
		'entrydt'
	];
}
