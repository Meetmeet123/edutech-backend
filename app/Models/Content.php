<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Content
 * 
 * @property int $id
 * @property string|null $title
 * @property string|null $type
 * @property string|null $is_public
 * @property int|null $class_id
 * @property int $cls_sec_id
 * @property string|null $file
 * @property int $created_by
 * @property string|null $note
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon $date
 * @property int|null $subject_id
 * @property string|null $ftype
 * @property string|null $fpath
 * @property string|null $site_code
 * @property string|null $fsize
 * 
 * @property Collection|ContentFor[] $content_fors
 *
 * @package App\Models
 */
class Content extends Model
{
	protected $table = 'contents';

	protected $casts = [
		'class_id' => 'int',
		'cls_sec_id' => 'int',
		'created_by' => 'int',
		'date' => 'datetime',
		'subject_id' => 'int'
	];

	protected $fillable = [
		'title',
		'type',
		'is_public',
		'class_id',
		'cls_sec_id',
		'file',
		'created_by',
		'note',
		'is_active',
		'date',
		'subject_id',
		'ftype',
		'fpath',
		'site_code',
		'fsize'
	];

	public function content_fors()
	{
		return $this->hasMany(ContentFor::class);
	}
}
