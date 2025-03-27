<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Captcha
 * 
 * @property int $id
 * @property string $name
 * @property int $status
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Captcha extends Model
{
	protected $table = 'captcha';
	public $timestamps = false;

	protected $casts = [
		'status' => 'int'
	];

	protected $fillable = [
		'name',
		'status'
	];
}
