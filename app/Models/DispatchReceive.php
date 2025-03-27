<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DispatchReceive
 * 
 * @property int $id
 * @property string $reference_no
 * @property string $to_title
 * @property string $address
 * @property string $note
 * @property string $from_title
 * @property string $date
 * @property string $image
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string $type
 *
 * @package App\Models
 */
class DispatchReceive extends Model
{
	protected $table = 'dispatch_receive';

	protected $fillable = [
		'reference_no',
		'to_title',
		'address',
		'note',
		'from_title',
		'date',
		'image',
		'type'
	];
}
