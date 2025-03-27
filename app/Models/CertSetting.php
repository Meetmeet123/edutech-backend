<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CertSetting
 * 
 * @property int $id
 * @property string|null $cert_type
 * @property string|null $inst_type
 * @property string|null $cert_auto_insert
 * @property string|null $cert_prefix
 * @property string|null $cert_start_from
 * @property string|null $cert_no_digit
 * @property string|null $cert_update_status
 * @property int|null $created_by
 * @property Carbon|null $created_ts
 * @property string|null $updated_ts
 *
 * @package App\Models
 */
class CertSetting extends Model
{
	protected $table = 'cert_settings';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'created_ts' => 'datetime'
	];

	protected $fillable = [
		'cert_type',
		'inst_type',
		'cert_auto_insert',
		'cert_prefix',
		'cert_start_from',
		'cert_no_digit',
		'cert_update_status',
		'created_by',
		'created_ts',
		'updated_ts'
	];
}
