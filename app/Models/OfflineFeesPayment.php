<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OfflineFeesPayment
 * 
 * @property int $id
 * @property string|null $invoice_id
 * @property int|null $student_session_id
 * @property int|null $student_fees_master_id
 * @property int|null $fee_groups_feetype_id
 * @property int|null $student_transport_fee_id
 * @property Carbon|null $payment_date
 * @property string|null $bank_from
 * @property string|null $bank_account_transferred
 * @property string|null $reference
 * @property float|null $amount
 * @property Carbon|null $submit_date
 * @property Carbon|null $approve_date
 * @property string|null $attachment
 * @property string|null $reply
 * @property int|null $approved_by
 * @property string|null $is_active
 * @property Carbon $created_at
 * 
 * @property StudentFeesMaster|null $student_fees_master
 * @property FeeGroupsFeetype|null $fee_groups_feetype
 * @property StudentTransportFee|null $student_transport_fee
 * @property Staff|null $staff
 * @property StudentSession|null $student_session
 *
 * @package App\Models
 */
class OfflineFeesPayment extends Model
{
	protected $table = 'offline_fees_payments';
	public $timestamps = false;

	protected $casts = [
		'student_session_id' => 'int',
		'student_fees_master_id' => 'int',
		'fee_groups_feetype_id' => 'int',
		'student_transport_fee_id' => 'int',
		'payment_date' => 'datetime',
		'amount' => 'float',
		'submit_date' => 'datetime',
		'approve_date' => 'datetime',
		'approved_by' => 'int'
	];

	protected $fillable = [
		'invoice_id',
		'student_session_id',
		'student_fees_master_id',
		'fee_groups_feetype_id',
		'student_transport_fee_id',
		'payment_date',
		'bank_from',
		'bank_account_transferred',
		'reference',
		'amount',
		'submit_date',
		'approve_date',
		'attachment',
		'reply',
		'approved_by',
		'is_active'
	];

	public function student_fees_master()
	{
		return $this->belongsTo(StudentFeesMaster::class);
	}

	public function fee_groups_feetype()
	{
		return $this->belongsTo(FeeGroupsFeetype::class);
	}

	public function student_transport_fee()
	{
		return $this->belongsTo(StudentTransportFee::class);
	}

	public function staff()
	{
		return $this->belongsTo(Staff::class, 'approved_by');
	}

	public function student_session()
	{
		return $this->belongsTo(StudentSession::class);
	}
}
