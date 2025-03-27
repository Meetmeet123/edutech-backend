<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FollowUp
 * 
 * @property int $id
 * @property int $enquiry_id
 * @property Carbon $date
 * @property Carbon $next_date
 * @property string $response
 * @property string $note
 * @property string $followup_by
 *
 * @package App\Models
 */
class FollowUp extends Model
{
	protected $table = 'follow_up';
	public $timestamps = false;

	protected $casts = [
		'enquiry_id' => 'int',
		'date' => 'datetime',
		'next_date' => 'datetime'
	];

	protected $fillable = [
		'enquiry_id',
		'date',
		'next_date',
		'response',
		'note',
		'followup_by'
	];
}
