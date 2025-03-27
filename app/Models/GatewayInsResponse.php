<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GatewayInsResponse
 * 
 * @property int $id
 * @property int|null $gateway_ins_id
 * @property string|null $posted_data
 * @property string|null $response
 * @property Carbon $created_at
 * 
 * @property GatewayIn|null $gateway_in
 *
 * @package App\Models
 */
class GatewayInsResponse extends Model
{
	protected $table = 'gateway_ins_response';
	public $timestamps = false;

	protected $casts = [
		'gateway_ins_id' => 'int'
	];

	protected $fillable = [
		'gateway_ins_id',
		'posted_data',
		'response'
	];

	public function gateway_in()
	{
		return $this->belongsTo(GatewayIn::class, 'gateway_ins_id');
	}
}
