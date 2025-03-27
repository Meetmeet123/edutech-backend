<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentTransportFee
 * 
 * @property int $id
 * @property int|null $student_session_id
 * @property float|null $amount
 * @property float $amount_discount
 * @property float $amount_fine
 * @property string|null $description
 * @property Carbon|null $date
 * @property string|null $is_active
 * @property string $payment_mode
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|OfflineFeesPayment[] $offline_fees_payments
 *
 * @package App\Models
 */
class StudentTransportFee extends Model
{
	protected $table = 'student_transport_fees';

	protected $casts = [
		'student_session_id' => 'int',
		'amount' => 'float',
		'amount_discount' => 'float',
		'amount_fine' => 'float',
		'date' => 'datetime'
	];

	protected $fillable = [
		'student_session_id',
		'amount',
		'amount_discount',
		'amount_fine',
		'description',
		'date',
		'is_active',
		'payment_mode'
	];

	public function offline_fees_payments()
	{
		return $this->hasMany(OfflineFeesPayment::class);
	}
}
