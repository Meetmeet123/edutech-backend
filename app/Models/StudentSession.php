<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentSession
 * 
 * @property int $id
 * @property int|null $session_id
 * @property int|null $student_id
 * @property int|null $course_id
 * @property int|null $class_id
 * @property int|null $section_id
 * @property int $route_id
 * @property int $hostel_room_id
 * @property int|null $vehroute_id
 * @property float $transport_fees
 * @property float $fees_discount
 * @property string|null $is_active
 * @property int $is_alumni
 * @property int $default_login
 * @property string|null $final_exam_mark_total
 * @property string|null $final_exam_mark_obtain
 * @property string|null $final_exam_grade
 * @property string|null $next_roll_no
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|DailyAssignment[] $daily_assignments
 * @property Collection|ExamGroupClassBatchExamStudent[] $exam_group_class_batch_exam_students
 * @property Collection|MultiClassStudent[] $multi_class_students
 * @property Collection|OfflineFeesPayment[] $offline_fees_payments
 * @property Collection|OnlineexamStudent[] $onlineexam_students
 *
 * @package App\Models
 */
class StudentSession extends Model
{
	protected $table = 'student_session';

	protected $casts = [
		'session_id' => 'int',
		'student_id' => 'int',
		'course_id' => 'int',
		'class_id' => 'int',
		'section_id' => 'int',
		'route_id' => 'int',
		'hostel_room_id' => 'int',
		'vehroute_id' => 'int',
		'transport_fees' => 'float',
		'fees_discount' => 'float',
		'is_alumni' => 'int',
		'default_login' => 'int'
	];

	protected $fillable = [
		'session_id',
		'student_id',
		'course_id',
		'class_id',
		'section_id',
		'route_id',
		'hostel_room_id',
		'vehroute_id',
		'transport_fees',
		'fees_discount',
		'is_active',
		'is_alumni',
		'default_login',
		'final_exam_mark_total',
		'final_exam_mark_obtain',
		'final_exam_grade',
		'next_roll_no'
	];

	public function daily_assignments()
	{
		return $this->hasMany(DailyAssignment::class);
	}

	public function exam_group_class_batch_exam_students()
	{
		return $this->hasMany(ExamGroupClassBatchExamStudent::class);
	}

	public function multi_class_students()
	{
		return $this->hasMany(MultiClassStudent::class);
	}

	public function offline_fees_payments()
	{
		return $this->hasMany(OfflineFeesPayment::class);
	}

	public function onlineexam_students()
	{
		return $this->hasMany(OnlineexamStudent::class);
	}
}
