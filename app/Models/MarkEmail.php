<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MarkEmail
 * 
 * @property int $id
 * @property int $exam_id
 * @property int $class_id
 * @property int $receiver_role_id
 * @property int $academic_year_id
 * @property int $sender_role_id
 * @property string $subject
 * @property string $note
 * @property bool $status
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property int $created_by
 * @property int $modified_by
 *
 * @package App\Models
 */
class MarkEmail extends Model
{
	protected $table = 'mark_emails';
	public $timestamps = false;

	protected $casts = [
		'exam_id' => 'int',
		'class_id' => 'int',
		'receiver_role_id' => 'int',
		'academic_year_id' => 'int',
		'sender_role_id' => 'int',
		'status' => 'bool',
		'modified_at' => 'datetime',
		'created_by' => 'int',
		'modified_by' => 'int'
	];

	protected $fillable = [
		'exam_id',
		'class_id',
		'receiver_role_id',
		'academic_year_id',
		'sender_role_id',
		'subject',
		'note',
		'status',
		'modified_at',
		'created_by',
		'modified_by'
	];
}
