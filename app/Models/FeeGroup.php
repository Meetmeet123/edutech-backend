<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FeeGroup
 * 
 * @property int $id
 * @property string|null $name
 * @property int $is_system
 * @property string|null $description
 * @property string $is_active
 * @property Carbon $created_at
 * 
 * @property Collection|Feetype[] $feetypes
 * @property Collection|FeeSessionGroup[] $fee_session_groups
 *
 * @package App\Models
 */
class FeeGroup extends Model
{
	protected $table = 'fee_groups';
	public $timestamps = false;

	protected $casts = [
		'is_system' => 'int'
	];

	protected $fillable = [
		'name',
		'is_system',
		'description',
		'is_active'
	];

	public function feetypes()
	{
		return $this->belongsToMany(Feetype::class, 'fee_groups_feetype', 'fee_groups_id')
					->withPivot('id', 'fee_session_group_id', 'session_id', 'amount', 'fine_type', 'due_date', 'fee_receipt_date', 'fine_percentage', 'fine_amount', 'is_active');
	}

	public function fee_session_groups()
	{
		return $this->hasMany(FeeSessionGroup::class, 'fee_groups_id');
	}
}
