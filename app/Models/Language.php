<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 * 
 * @property int $id
 * @property string|null $language
 * @property string $short_code
 * @property string $country_code
 * @property string $is_deleted
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Language extends Model
{
	protected $table = 'languages';

	protected $fillable = [
		'language',
		'short_code',
		'country_code',
		'is_deleted',
		'is_active'
	];
}
