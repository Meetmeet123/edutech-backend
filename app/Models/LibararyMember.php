<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LibararyMember
 * 
 * @property int $id
 * @property string|null $library_card_no
 * @property string|null $member_type
 * @property int|null $member_id
 * @property string $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class LibararyMember extends Model
{
	protected $table = 'libarary_members';
	public $timestamps = false;

	protected $casts = [
		'member_id' => 'int'
	];

	protected $fillable = [
		'library_card_no',
		'member_type',
		'member_id',
		'is_active'
	];
}
