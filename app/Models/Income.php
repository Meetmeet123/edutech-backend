<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Income
 * 
 * @property int $id
 * @property string|null $inc_head_id
 * @property string|null $name
 * @property string $invoice_no
 * @property Carbon|null $date
 * @property float|null $amount
 * @property string|null $note
 * @property string|null $is_active
 * @property string|null $is_deleted
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $documents
 *
 * @package App\Models
 */
class Income extends Model
{
	protected $table = 'income';

	protected $casts = [
		'date' => 'datetime',
		'amount' => 'float'
	];

	protected $fillable = [
		'inc_head_id',
		'name',
		'invoice_no',
		'date',
		'amount',
		'note',
		'is_active',
		'is_deleted',
		'documents'
	];
}
