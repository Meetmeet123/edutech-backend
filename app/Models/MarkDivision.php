<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MarkDivision
 * 
 * @property int $id
 * @property string|null $name
 * @property float|null $percentage_from
 * @property float|null $percentage_to
 * @property int|null $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class MarkDivision extends Model
{
	protected $table = 'mark_divisions';
	public $timestamps = false;

	protected $casts = [
		'percentage_from' => 'float',
		'percentage_to' => 'float',
		'is_active' => 'int'
	];

	protected $fillable = [
		'name',
		'percentage_from',
		'percentage_to',
		'is_active'
	];
}
