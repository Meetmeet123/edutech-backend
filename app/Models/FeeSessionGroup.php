<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FeeSessionGroup
 * 
 * @property int $id
 * @property int|null $fee_groups_id
 * @property int|null $session_id
 * @property string $is_active
 * @property Carbon $created_at
 * 
 * @property FeeGroup|null $fee_group
 * @property Session|null $session
 * @property Collection|FeeGroupsFeetype[] $fee_groups_feetypes
 *
 * @package App\Models
 */
class FeeSessionGroup extends Model
{
	protected $table = 'fee_session_groups';
	public $timestamps = false;

	protected $casts = [
		'fee_groups_id' => 'int',
		'session_id' => 'int'
	];

	protected $fillable = [
		'fee_groups_id',
		'session_id',
		'is_active'
	];

	public function fee_group()
	{
		return $this->belongsTo(FeeGroup::class, 'fee_groups_id');
	}

	public function session()
	{
		return $this->belongsTo(Session::class);
	}

	public function fee_groups_feetypes()
	{
		return $this->hasMany(FeeGroupsFeetype::class);
	}
}
