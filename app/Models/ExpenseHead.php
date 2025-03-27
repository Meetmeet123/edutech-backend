<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpenseHead
 * 
 * @property int $id
 * @property string|null $exp_category
 * @property string|null $description
 * @property string|null $is_active
 * @property string|null $is_deleted
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ExpenseHead extends Model
{
	protected $table = 'expense_head';

	protected $fillable = [
		'exp_category',
		'description',
		'is_active',
		'is_deleted'
	];
}
