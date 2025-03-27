<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShareContent
 * 
 * @property int $id
 * @property string|null $send_to
 * @property string|null $title
 * @property Carbon|null $share_date
 * @property Carbon|null $valid_upto
 * @property string|null $description
 * @property int|null $created_by
 * @property Carbon $created_at
 * 
 * @property Staff|null $staff
 *
 * @package App\Models
 */
class ShareContent extends Model
{
	protected $table = 'share_contents';
	public $timestamps = false;

	protected $casts = [
		'share_date' => 'datetime',
		'valid_upto' => 'datetime',
		'created_by' => 'int'
	];

	protected $fillable = [
		'send_to',
		'title',
		'share_date',
		'valid_upto',
		'description',
		'created_by'
	];

	public function staff()
	{
		return $this->belongsTo(Staff::class, 'created_by');
	}
}
