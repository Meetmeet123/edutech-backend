<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VisitorsPurpose
 * 
 * @property int $id
 * @property string $visitors_purpose
 * @property string $description
 *
 * @package App\Models
 */
class VisitorsPurpose extends Model
{
	protected $table = 'visitors_purpose';
	public $timestamps = false;

	protected $fillable = [
		'visitors_purpose',
		'description'
	];
}
