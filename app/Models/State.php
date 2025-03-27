<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class State
 * 
 * @property int $stid
 * @property int|null $ctid
 * @property string|null $state
 * @property Carbon $created_ts
 *
 * @package App\Models
 */
class State extends Model
{
	protected $table = 'state';
	protected $primaryKey = 'stid';
	public $timestamps = false;

	protected $casts = [
		'ctid' => 'int',
		'created_ts' => 'datetime'
	];

	protected $fillable = [
		'ctid',
		'state',
		'created_ts'
	];
}
