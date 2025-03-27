<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentAdmissionFeesDeposite
 * 
 * @property int $id
 * @property int|null $student_session_id
 * @property int|null $student_fees_master_id
 * @property int|null $fee_groups_feetype_id
 * @property int|null $fee_session_group_id
 * @property int|null $fee_groups_id
 * @property string|null $amount
 * @property string|null $payment_date
 * @property string|null $mode
 * @property string|null $note
 * @property string|null $feetype_amount_detail
 * @property int|null $status
 * @property int|null $created_by
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class StudentAdmissionFeesDeposite extends Model
{
	protected $table = 'student_admission_fees_deposite';

	protected $casts = [
		'student_session_id' => 'int',
		'student_fees_master_id' => 'int',
		'fee_groups_feetype_id' => 'int',
		'fee_session_group_id' => 'int',
		'fee_groups_id' => 'int',
		'status' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'student_session_id',
		'student_fees_master_id',
		'fee_groups_feetype_id',
		'fee_session_group_id',
		'fee_groups_id',
		'amount',
		'payment_date',
		'mode',
		'note',
		'feetype_amount_detail',
		'status',
		'created_by'
	];
}
