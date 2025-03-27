<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentFeesProcessing
 * 
 * @property int $id
 * @property int $gateway_ins_id
 * @property string $fee_category
 * @property int|null $student_fees_master_id
 * @property int|null $fee_groups_feetype_id
 * @property int|null $student_transport_fee_id
 * @property string|null $amount_detail
 * @property string $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class StudentFeesProcessing extends Model
{
	protected $table = 'student_fees_processing';
	public $timestamps = false;

	protected $casts = [
		'gateway_ins_id' => 'int',
		'student_fees_master_id' => 'int',
		'fee_groups_feetype_id' => 'int',
		'student_transport_fee_id' => 'int'
	];

	protected $fillable = [
		'gateway_ins_id',
		'fee_category',
		'student_fees_master_id',
		'fee_groups_feetype_id',
		'student_transport_fee_id',
		'amount_detail',
		'is_active'
	];
}
