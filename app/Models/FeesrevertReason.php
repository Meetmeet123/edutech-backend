<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FeesrevertReason
 * 
 * @property int $id
 * @property string $reason
 * @property string|null $description
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class FeesrevertReason extends Model
{
	protected $table = 'feesrevert_reasons';

	protected $fillable = [
		'reason',
		'description',
		'status'
	];
}
