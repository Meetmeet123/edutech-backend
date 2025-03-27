<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Feetype
 * 
 * @property int $id
 * @property int $is_system
 * @property int|null $feecategory_id
 * @property string|null $type
 * @property string|null $collection_type
 * @property int|null $bank_account
 * @property string $code
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string $description
 * 
 * @property Collection|FeeGroup[] $fee_groups
 *
 * @package App\Models
 */
class Feetype extends Model
{
	protected $table = 'feetype';

	protected $casts = [
		'is_system' => 'int',
		'feecategory_id' => 'int',
		'bank_account' => 'int'
	];

	protected $fillable = [
		'is_system',
		'feecategory_id',
		'type',
		'collection_type',
		'bank_account',
		'code',
		'is_active',
		'description'
	];

	public function fee_groups()
	{
		return $this->belongsToMany(FeeGroup::class, 'fee_groups_feetype', 'feetype_id', 'fee_groups_id')
					->withPivot('id', 'fee_session_group_id', 'session_id', 'amount', 'fine_type', 'due_date', 'fee_receipt_date', 'fine_percentage', 'fine_amount', 'is_active');
	}
}
