<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ComplaintType
 * 
 * @property int $id
 * @property string $complaint_type
 * @property string $description
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class ComplaintType extends Model
{
	protected $table = 'complaint_type';
	public $timestamps = false;

	protected $fillable = [
		'complaint_type',
		'description'
	];
}
