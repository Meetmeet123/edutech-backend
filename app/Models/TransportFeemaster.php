<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TransportFeemaster
 * 
 * @property int $id
 * @property int $session_id
 * @property string|null $month
 * @property Carbon|null $due_date
 * @property float|null $fine_amount
 * @property string|null $fine_type
 * @property float|null $fine_percentage
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class TransportFeemaster extends Model
{
	protected $table = 'transport_feemaster';
	public $timestamps = false;

	protected $casts = [
		'session_id' => 'int',
		'due_date' => 'datetime',
		'fine_amount' => 'float',
		'fine_percentage' => 'float'
	];

	protected $fillable = [
		'session_id',
		'month',
		'due_date',
		'fine_amount',
		'fine_type',
		'fine_percentage'
	];
}
