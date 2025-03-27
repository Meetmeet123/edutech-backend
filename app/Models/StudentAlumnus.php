<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentAlumnus
 * 
 * @property int $id
 * @property string|null $curr_session_id
 * @property string|null $end_session_id
 * @property int|null $student_id
 * @property int|null $curr_class_id
 * @property int|null $end_class_id
 * @property int|null $curr_section_id
 * @property int|null $end_section_id
 * @property int|null $route_id
 * @property int|null $hostel_room_id
 * @property int|null $vehroute_id
 * @property string|null $transport_fees
 * @property string|null $fees_discount
 * @property string|null $is_active
 * @property string|null $note
 * @property int|null $last_exam_id
 * @property string|null $last_exam_result
 * @property int|null $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class StudentAlumnus extends Model
{
	protected $table = 'student_alumni';

	protected $casts = [
		'student_id' => 'int',
		'curr_class_id' => 'int',
		'end_class_id' => 'int',
		'curr_section_id' => 'int',
		'end_section_id' => 'int',
		'route_id' => 'int',
		'hostel_room_id' => 'int',
		'vehroute_id' => 'int',
		'last_exam_id' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'curr_session_id',
		'end_session_id',
		'student_id',
		'curr_class_id',
		'end_class_id',
		'curr_section_id',
		'end_section_id',
		'route_id',
		'hostel_room_id',
		'vehroute_id',
		'transport_fees',
		'fees_discount',
		'is_active',
		'note',
		'last_exam_id',
		'last_exam_result',
		'created_by'
	];
}
