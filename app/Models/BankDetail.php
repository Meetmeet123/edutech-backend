<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BankDetail
 * 
 * @property int $id
 * @property string $account_number
 * @property string|null $bank_name
 * @property string $branch_name
 * @property string $ac_holder_name
 * @property string $ifsc_code
 * @property string $is_primary
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class BankDetail extends Model
{
	protected $table = 'bank_details';

	protected $fillable = [
		'account_number',
		'bank_name',
		'branch_name',
		'ac_holder_name',
		'ifsc_code',
		'is_primary',
		'status'
	];
}
