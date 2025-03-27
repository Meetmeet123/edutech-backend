<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IncomeHead
 * 
 * @property int $id
 * @property string|null $income_category
 * @property string|null $description
 * @property string $is_active
 * @property string $is_deleted
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class IncomeHead extends Model
{
	protected $table = 'income_head';

	protected $fillable = [
		'income_category',
		'description',
		'is_active',
		'is_deleted'
	];
}
