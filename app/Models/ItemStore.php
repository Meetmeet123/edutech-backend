<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemStore
 * 
 * @property int $id
 * @property string $item_store
 * @property string $code
 * @property string $description
 * 
 * @property Collection|ItemStock[] $item_stocks
 *
 * @package App\Models
 */
class ItemStore extends Model
{
	protected $table = 'item_store';
	public $timestamps = false;

	protected $fillable = [
		'item_store',
		'code',
		'description'
	];

	public function item_stocks()
	{
		return $this->hasMany(ItemStock::class, 'store_id');
	}
}
