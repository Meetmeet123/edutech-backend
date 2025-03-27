<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Enquiry
 * 
 * @property int $id
 * @property string $name
 * @property string $contact
 * @property string $address
 * @property string $reference
 * @property Carbon $date
 * @property string $description
 * @property Carbon $follow_up_date
 * @property string $note
 * @property string $source
 * @property string|null $email
 * @property string $assigned
 * @property int $class
 * @property string|null $no_of_child
 * @property string|null $last_name
 * @property string|null $child_first_name
 * @property string|null $child_last_name
 * @property string|null $child_curr_school
 * @property string|null $landmark
 * @property string|null $city
 * @property string|null $state
 * @property string|null $pincode
 * @property string|null $child_gender
 * @property string|null $child_curr_grade
 * @property string|null $child_adm_session
 * @property string|null $enquiry_purpose
 * @property int|null $action_status
 * @property string $status
 *
 * @package App\Models
 */
class Enquiry extends Model
{
	protected $table = 'enquiry';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'follow_up_date' => 'datetime',
		'class' => 'int',
		'action_status' => 'int'
	];

	protected $fillable = [
		'name',
		'contact',
		'address',
		'reference',
		'date',
		'description',
		'follow_up_date',
		'note',
		'source',
		'email',
		'assigned',
		'class',
		'no_of_child',
		'last_name',
		'child_first_name',
		'child_last_name',
		'child_curr_school',
		'landmark',
		'city',
		'state',
		'pincode',
		'child_gender',
		'child_curr_grade',
		'child_adm_session',
		'enquiry_purpose',
		'action_status',
		'status'
	];
}
