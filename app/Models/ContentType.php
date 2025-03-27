<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContentType
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class ContentType extends Model
{
	protected $table = 'content_types';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'is_active'
	];
}
