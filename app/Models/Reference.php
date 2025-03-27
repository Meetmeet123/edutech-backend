<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reference
 * 
 * @property int $id
 * @property string $reference
 * @property string $description
 *
 * @package App\Models
 */
class Reference extends Model
{
	protected $table = 'reference';
	public $timestamps = false;

	protected $fillable = [
		'reference',
		'description'
	];
}
