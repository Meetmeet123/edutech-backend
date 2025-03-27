<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DisableReason
 * 
 * @property int $id
 * @property string $reason
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class DisableReason extends Model
{
	protected $table = 'disable_reason';
	public $timestamps = false;

	protected $fillable = [
		'reason'
	];
}
