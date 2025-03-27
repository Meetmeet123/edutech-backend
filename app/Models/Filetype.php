<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Filetype
 * 
 * @property int $id
 * @property string|null $file_extension
 * @property string|null $file_mime
 * @property int $file_size
 * @property string|null $image_extension
 * @property string|null $image_mime
 * @property int $image_size
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Filetype extends Model
{
	protected $table = 'filetypes';
	public $timestamps = false;

	protected $casts = [
		'file_size' => 'int',
		'image_size' => 'int'
	];

	protected $fillable = [
		'file_extension',
		'file_mime',
		'file_size',
		'image_extension',
		'image_mime',
		'image_size'
	];
}
