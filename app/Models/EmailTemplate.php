<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailTemplate
 * 
 * @property int $id
 * @property string $title
 * @property string $message
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class EmailTemplate extends Model
{
	protected $table = 'email_template';
	public $timestamps = false;

	protected $fillable = [
		'title',
		'message'
	];
}
