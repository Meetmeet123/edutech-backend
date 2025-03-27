<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FeesDiscount
 * 
 * @property int $id
 * @property int|null $session_id
 * @property string|null $name
 * @property string|null $code
 * @property float|null $amount
 * @property string|null $description
 * @property string $is_active
 * @property Carbon $created_at
 * 
 * @property Session|null $session
 *
 * @package App\Models
 */
class FeesDiscount extends Model
{
	protected $table = 'fees_discounts';
	public $timestamps = false;

	protected $casts = [
		'session_id' => 'int',
		'amount' => 'float'
	];

	protected $fillable = [
		'session_id',
		'name',
		'code',
		'amount',
		'description',
		'is_active'
	];

	public function session()
	{
		return $this->belongsTo(Session::class);
	}
}
