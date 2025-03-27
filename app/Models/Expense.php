<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Expense
 * 
 * @property int $id
 * @property int|null $exp_head_id
 * @property int|null $inc_head_id
 * @property string|null $name
 * @property string $invoice_no
 * @property Carbon|null $date
 * @property float|null $amount
 * @property string|null $documents
 * @property string|null $note
 * @property string|null $is_active
 * @property string|null $is_deleted
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Expense extends Model
{
	protected $table = 'expenses';

	protected $casts = [
		'exp_head_id' => 'int',
		'inc_head_id' => 'int',
		'date' => 'datetime',
		'amount' => 'float'
	];

	protected $fillable = [
		'exp_head_id',
		'inc_head_id',
		'name',
		'invoice_no',
		'date',
		'amount',
		'documents',
		'note',
		'is_active',
		'is_deleted'
	];
}
