<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FrontCmsProgramPhoto
 * 
 * @property int $id
 * @property int|null $program_id
 * @property int $media_gallery_id
 * @property Carbon $created_at
 * 
 * @property FrontCmsProgram|null $front_cms_program
 *
 * @package App\Models
 */
class FrontCmsProgramPhoto extends Model
{
	protected $table = 'front_cms_program_photos';
	public $timestamps = false;

	protected $casts = [
		'program_id' => 'int',
		'media_gallery_id' => 'int'
	];

	protected $fillable = [
		'program_id',
		'media_gallery_id'
	];

	public function front_cms_program()
	{
		return $this->belongsTo(FrontCmsProgram::class, 'program_id');
	}
}
