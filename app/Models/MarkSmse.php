<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MarkSmse
 * 
 * @property int $id
 * @property int $exam_id
 * @property int $class_id
 * @property int $receiver_role_id
 * @property string $sms_gateway
 * @property int $academic_year_id
 * @property int $sender_role_id
 * @property bool $status
 * @property Carbon $created_at
 * @property int $created_by
 *
 * @package App\Models
 */
class MarkSmse extends Model
{
	protected $table = 'mark_smses';
	public $timestamps = false;

	protected $casts = [
		'exam_id' => 'int',
		'class_id' => 'int',
		'receiver_role_id' => 'int',
		'academic_year_id' => 'int',
		'sender_role_id' => 'int',
		'status' => 'bool',
		'created_by' => 'int'
	];

	protected $fillable = [
		'exam_id',
		'class_id',
		'receiver_role_id',
		'sms_gateway',
		'academic_year_id',
		'sender_role_id',
		'status',
		'created_by'
	];
}
