<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PrintHeaderfooter
 * 
 * @property int $id
 * @property string $print_type
 * @property string $header_image
 * @property string $footer_content
 * @property int $created_by
 * @property Carbon $entry_date
 *
 * @package App\Models
 */
class PrintHeaderfooter extends Model
{
	protected $table = 'print_headerfooter';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'entry_date' => 'datetime'
	];

	protected $fillable = [
		'print_type',
		'header_image',
		'footer_content',
		'created_by',
		'entry_date'
	];
}
