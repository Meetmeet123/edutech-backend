<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemCategory
 * 
 * @property int $id
 * @property string $item_category
 * @property string $is_active
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ItemIssue[] $item_issues
 *
 * @package App\Models
 */
class ItemCategory extends Model
{
	protected $table = 'item_category';

	protected $fillable = [
		'item_category',
		'is_active',
		'description'
	];

	public function item_issues()
	{
		return $this->hasMany(ItemIssue::class);
	}
}
