<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentFeesDeposite
 * 
 * @property int $id
 * @property int|null $student_fees_master_id
 * @property int|null $fee_groups_feetype_id
 * @property string|null $amount_detail
 * @property string $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class StudentFeesDeposite extends Model
{
	protected $table = 'student_fees_deposite';
	public $timestamps = false;

	protected $casts = [
		'student_fees_master_id' => 'int',
		'fee_groups_feetype_id' => 'int'
	];

	protected $fillable = [
		'student_fees_master_id',
		'fee_groups_feetype_id',
		'amount_detail',
		'is_active'
	];
}
