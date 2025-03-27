<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemStock
 * 
 * @property int $id
 * @property int|null $item_id
 * @property int|null $supplier_id
 * @property string $symbol
 * @property int|null $store_id
 * @property int|null $quantity
 * @property string $purchase_price
 * @property Carbon $date
 * @property string|null $attachment
 * @property string $description
 * @property string|null $is_active
 * @property string|null $dealer_price
 * @property string|null $mrp_price
 * @property string|null $sell_price
 * @property Carbon $created_at
 * 
 * @property Item|null $item
 * @property ItemSupplier|null $item_supplier
 * @property ItemStore|null $item_store
 *
 * @package App\Models
 */
class ItemStock extends Model
{
	protected $table = 'item_stock';
	public $timestamps = false;

	protected $casts = [
		'item_id' => 'int',
		'supplier_id' => 'int',
		'store_id' => 'int',
		'quantity' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'item_id',
		'supplier_id',
		'symbol',
		'store_id',
		'quantity',
		'purchase_price',
		'date',
		'attachment',
		'description',
		'is_active',
		'dealer_price',
		'mrp_price',
		'sell_price'
	];

	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	public function item_supplier()
	{
		return $this->belongsTo(ItemSupplier::class, 'supplier_id');
	}

	public function item_store()
	{
		return $this->belongsTo(ItemStore::class, 'store_id');
	}
}
