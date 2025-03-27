<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 * 
 * @property int $id
 * @property int|null $item_category_id
 * @property string $name
 * @property string $unit
 * @property string|null $item_photo
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property int|null $item_store_id
 * @property int|null $item_supplier_id
 * @property int $quantity
 * @property Carbon $date
 * 
 * @property Collection|ItemIssue[] $item_issues
 * @property Collection|ItemStock[] $item_stocks
 *
 * @package App\Models
 */
class Item extends Model
{
	protected $table = 'item';

	protected $casts = [
		'item_category_id' => 'int',
		'item_store_id' => 'int',
		'item_supplier_id' => 'int',
		'quantity' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'item_category_id',
		'name',
		'unit',
		'item_photo',
		'description',
		'item_store_id',
		'item_supplier_id',
		'quantity',
		'date'
	];

	public function item_issues()
	{
		return $this->hasMany(ItemIssue::class);
	}

	public function item_stocks()
	{
		return $this->hasMany(ItemStock::class);
	}
}
