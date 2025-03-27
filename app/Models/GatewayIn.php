<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GatewayIn
 * 
 * @property int $id
 * @property int|null $online_admission_id
 * @property string $gateway_name
 * @property string $module_type
 * @property string $unique_id
 * @property string $parameter_details
 * @property string $payment_status
 * @property Carbon $created_at
 * 
 * @property OnlineAdmission|null $online_admission
 * @property Collection|GatewayInsResponse[] $gateway_ins_responses
 *
 * @package App\Models
 */
class GatewayIn extends Model
{
	protected $table = 'gateway_ins';
	public $timestamps = false;

	protected $casts = [
		'online_admission_id' => 'int'
	];

	protected $fillable = [
		'online_admission_id',
		'gateway_name',
		'module_type',
		'unique_id',
		'parameter_details',
		'payment_status'
	];

	public function online_admission()
	{
		return $this->belongsTo(OnlineAdmission::class);
	}

	public function gateway_ins_responses()
	{
		return $this->hasMany(GatewayInsResponse::class, 'gateway_ins_id');
	}
}
