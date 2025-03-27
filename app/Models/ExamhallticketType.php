<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamhallticketType
 * 
 * @property int $id
 * @property string|null $type
 * @property string $key_value
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ExamhallticketType extends Model
{
	protected $table = 'examhallticket_type';

	protected $fillable = [
		'type',
		'key_value',
		'is_active'
	];
}
