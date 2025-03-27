<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Complaint
 * 
 * @property int $id
 * @property string $complaint_type
 * @property string $source
 * @property string $name
 * @property string $contact
 * @property string $email
 * @property Carbon $date
 * @property string $description
 * @property string $action_taken
 * @property string $assigned
 * @property string $note
 * @property string $image
 *
 * @package App\Models
 */
class Complaint extends Model
{
	protected $table = 'complaint';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime'
	];

	protected $fillable = [
		'complaint_type',
		'source',
		'name',
		'contact',
		'email',
		'date',
		'description',
		'action_taken',
		'assigned',
		'note',
		'image'
	];
}
