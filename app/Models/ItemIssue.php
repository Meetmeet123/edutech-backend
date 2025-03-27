<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemIssue
 * 
 * @property int $id
 * @property string|null $issue_type
 * @property string|null $issue_to
 * @property string|null $issue_by
 * @property Carbon|null $issue_date
 * @property Carbon|null $return_date
 * @property int|null $item_category_id
 * @property int|null $item_id
 * @property int $quantity
 * @property string $note
 * @property int $is_returned
 * @property Carbon $created_at
 * @property string|null $is_active
 * 
 * @property Item|null $item
 * @property ItemCategory|null $item_category
 *
 * @package App\Models
 */
class ItemIssue extends Model
{
	protected $table = 'item_issue';
	public $timestamps = false;

	protected $casts = [
		'issue_date' => 'datetime',
		'return_date' => 'datetime',
		'item_category_id' => 'int',
		'item_id' => 'int',
		'quantity' => 'int',
		'is_returned' => 'int'
	];

	protected $fillable = [
		'issue_type',
		'issue_to',
		'issue_by',
		'issue_date',
		'return_date',
		'item_category_id',
		'item_id',
		'quantity',
		'note',
		'is_returned',
		'is_active'
	];

	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	public function item_category()
	{
		return $this->belongsTo(ItemCategory::class);
	}
}
