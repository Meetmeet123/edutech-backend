<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShareUploadContent
 * 
 * @property int $id
 * @property int|null $upload_content_id
 * @property int|null $share_content_id
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class ShareUploadContent extends Model
{
	protected $table = 'share_upload_contents';
	public $timestamps = false;

	protected $casts = [
		'upload_content_id' => 'int',
		'share_content_id' => 'int'
	];

	protected $fillable = [
		'upload_content_id',
		'share_content_id'
	];
}
