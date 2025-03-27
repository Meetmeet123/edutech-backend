<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FeeGroupsFeetype
 * 
 * @property int $id
 * @property int|null $fee_session_group_id
 * @property int|null $fee_groups_id
 * @property int|null $feetype_id
 * @property int|null $session_id
 * @property float|null $amount
 * @property string $fine_type
 * @property Carbon|null $due_date
 * @property string|null $fee_receipt_date
 * @property float $fine_percentage
 * @property float $fine_amount
 * @property string $is_active
 * @property Carbon $created_at
 * 
 * @property FeeSessionGroup|null $fee_session_group
 * @property FeeGroup|null $fee_group
 * @property Feetype|null $feetype
 * @property Session|null $session
 * @property Collection|OfflineFeesPayment[] $offline_fees_payments
 *
 * @package App\Models
 */
class FeeGroupsFeetype extends Model
{
	protected $table = 'fee_groups_feetype';
	public $timestamps = false;

	protected $casts = [
		'fee_session_group_id' => 'int',
		'fee_groups_id' => 'int',
		'feetype_id' => 'int',
		'session_id' => 'int',
		'amount' => 'float',
		'due_date' => 'datetime',
		'fine_percentage' => 'float',
		'fine_amount' => 'float'
	];

	protected $fillable = [
		'fee_session_group_id',
		'fee_groups_id',
		'feetype_id',
		'session_id',
		'amount',
		'fine_type',
		'due_date',
		'fee_receipt_date',
		'fine_percentage',
		'fine_amount',
		'is_active'
	];

	public function fee_session_group()
	{
		return $this->belongsTo(FeeSessionGroup::class);
	}

	public function fee_group()
	{
		return $this->belongsTo(FeeGroup::class, 'fee_groups_id');
	}

	public function feetype()
	{
		return $this->belongsTo(Feetype::class);
	}

	public function session()
	{
		return $this->belongsTo(Session::class);
	}

	public function offline_fees_payments()
	{
		return $this->hasMany(OfflineFeesPayment::class);
	}
}
