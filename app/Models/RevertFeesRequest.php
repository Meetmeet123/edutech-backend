<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RevertFeesRequest
 * 
 * @property int $id
 * @property int $invoice_id
 * @property int $sub_invoice
 * @property int $student_session_id
 * @property string $revert_reason
 * @property string $request_by
 * @property string $status
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class RevertFeesRequest extends Model
{
	protected $table = 'revert_fees_request';
	public $timestamps = false;

	protected $casts = [
		'invoice_id' => 'int',
		'sub_invoice' => 'int',
		'student_session_id' => 'int'
	];

	protected $fillable = [
		'invoice_id',
		'sub_invoice',
		'student_session_id',
		'revert_reason',
		'request_by',
		'status'
	];
}
