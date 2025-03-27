<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemSupplier
 * 
 * @property int $id
 * @property string $item_supplier
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $contact_person_name
 * @property string $contact_person_phone
 * @property string $contact_person_email
 * @property string $description
 * 
 * @property Collection|ItemStock[] $item_stocks
 *
 * @package App\Models
 */
class ItemSupplier extends Model
{
	protected $table = 'item_supplier';
	public $timestamps = false;

	protected $fillable = [
		'item_supplier',
		'phone',
		'email',
		'address',
		'contact_person_name',
		'contact_person_phone',
		'contact_person_email',
		'description'
	];

	public function item_stocks()
	{
		return $this->hasMany(ItemStock::class, 'supplier_id');
	}
}
