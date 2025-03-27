<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Session
 * 
 * @property int $id
 * @property string|null $session
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|FeeGroupsFeetype[] $fee_groups_feetypes
 * @property Collection|FeeSessionGroup[] $fee_session_groups
 * @property Collection|FeesDiscount[] $fees_discounts
 * @property Collection|Lesson[] $lessons
 * @property Collection|Onlineexam[] $onlineexams
 * @property Collection|OnlineexamQuestion[] $onlineexam_questions
 *
 * @package App\Models
 */
class Session extends Model
{
	protected $table = 'sessions';

	protected $fillable = [
		'session',
		'is_active'
	];

	public function fee_groups_feetypes()
	{
		return $this->hasMany(FeeGroupsFeetype::class);
	}

	public function fee_session_groups()
	{
		return $this->hasMany(FeeSessionGroup::class);
	}

	public function fees_discounts()
	{
		return $this->hasMany(FeesDiscount::class);
	}

	public function lessons()
	{
		return $this->hasMany(Lesson::class);
	}

	public function onlineexams()
	{
		return $this->hasMany(Onlineexam::class);
	}

	public function onlineexam_questions()
	{
		return $this->hasMany(OnlineexamQuestion::class);
	}
}
