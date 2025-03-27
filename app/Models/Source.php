<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Source
 * 
 * @property int $id
 * @property string $source
 * @property string $description
 *
 * @package App\Models
 */
class Source extends Model
{
	protected $table = 'source';
	public $timestamps = false;

	protected $fillable = [
		'source',
		'description'
	];
}
