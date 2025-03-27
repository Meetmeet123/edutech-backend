<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CiSession
 * 
 * @property string $id
 * @property string|null $ip_address
 * @property string $data
 * @property string $timestamp
 * @property Carbon $created_ts
 *
 * @package App\Models
 */
class CiSession extends Model
{
	protected $table = 'ci_session';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'created_ts' => 'datetime'
	];

	protected $fillable = [
		'id',
		'ip_address',
		'data',
		'timestamp',
		'created_ts'
	];
}
