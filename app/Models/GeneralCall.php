<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GeneralCall
 * 
 * @property int $id
 * @property string $name
 * @property string $contact
 * @property Carbon $date
 * @property string $description
 * @property Carbon $follow_up_date
 * @property string $call_dureation
 * @property string $note
 * @property string $call_type
 *
 * @package App\Models
 */
class GeneralCall extends Model
{
	protected $table = 'general_calls';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'follow_up_date' => 'datetime'
	];

	protected $fillable = [
		'name',
		'contact',
		'date',
		'description',
		'follow_up_date',
		'call_dureation',
		'note',
		'call_type'
	];
}
