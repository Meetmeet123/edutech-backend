<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 * 
 * @property int $id
 * @property int $parent_id
 * @property string|null $admission_no
 * @property string|null $roll_no
 * @property string|null $exam_seat_no
 * @property string|null $admission_date
 * @property string|null $firstname
 * @property string|null $middlename
 * @property string|null $lastname
 * @property string $rte
 * @property string|null $image
 * @property string|null $mobileno
 * @property string|null $email
 * @property string|null $state
 * @property string|null $city
 * @property string|null $pincode
 * @property string|null $religion
 * @property string $cast
 * @property string|null $subcas
 * @property string|null $dob
 * @property string|null $gender
 * @property string|null $current_address
 * @property string|null $permanent_address
 * @property string|null $category_id
 * @property int $route_id
 * @property int $school_house_id
 * @property string $blood_group
 * @property int $vehroute_id
 * @property int $hostel_room_id
 * @property string|null $adhar_no
 * @property string|null $samagra_id
 * @property string|null $bank_account_no
 * @property string|null $bank_name
 * @property string|null $ifsc_code
 * @property string $guardian_is
 * @property string|null $father_name
 * @property string|null $father_phone
 * @property string|null $father_occupation
 * @property string|null $mother_name
 * @property string|null $mother_phone
 * @property string|null $mother_occupation
 * @property string|null $guardian_name
 * @property string|null $guardian_relation
 * @property string|null $guardian_phone
 * @property string $guardian_occupation
 * @property string|null $guardian_address
 * @property string $guardian_email
 * @property string $father_pic
 * @property string $mother_pic
 * @property string $guardian_pic
 * @property string|null $is_active
 * @property string|null $previous_school
 * @property string $height
 * @property string $weight
 * @property Carbon $measurement_date
 * @property string|null $app_key
 * @property string|null $parent_app_key
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon $disable_at
 * @property string $note
 * @property string|null $place_of_birth
 * @property string|null $birth_village
 * @property string|null $birth_town
 * @property string|null $birth_taluka
 * @property string|null $birth_district
 * @property string|null $father_edu_qualification
 * @property string|null $mother_edu_qualification
 * @property string|null $parent_annual_income
 * @property string|null $number_of_dependent
 * @property string|null $if_pupil_living_with_parent
 * @property string|null $nationality
 * @property string|null $mother_tongue
 * @property string|null $other_language_spoken
 * @property string|null $num_of_brother
 * @property string|null $elder_brother
 * @property string|null $younger_brother
 * @property string|null $num_of_sister
 * @property string|null $elder_sister
 * @property string|null $younger_sister
 * @property string|null $if_pupil_produced_last_school_leaving_certificate
 * @property string|null $date_produced_last_school_leaving_certificate
 * @property string|null $vaccinations
 * @property string|null $languages_studied
 * @property string|null $medium_of_instruction_in_last_school
 * @property string|null $admission_enquiry_no
 * @property string|null $reason_of_leaving
 * @property string|null $date_of_leaving
 * @property string|null $remarks
 * @property string|null $prev_school_name
 * @property string|null $prev_school_scholarship
 * @property string|null $prev_school_standard_covered
 * @property string|null $prev_school_tcnumber
 * @property string|null $prev_school_dateofleaving
 * @property string|null $prev_school_reasonofleaving
 * @property string|null $fillbyoffice_admittedto
 * @property string|null $fillbyoffice_onpaymentfees
 * @property string|null $fillbyoffice_paymentfeesreceiptno
 * @property string|null $fillbyoffice_anycomment
 * @property string|null $academic_preference
 * @property string|null $academic_conduct
 * @property string|null $fitness_cert
 * @property string|null $std_global_id
 * @property string|null $birth_state
 * @property string|null $std_board
 * @property string|null $std_sch_medium
 * @property int|null $online_adm_no
 * @property string|null $class_studing_since_when
 * @property string|null $sn_cert_leaving
 * @property string|null $sn_cert_bonafide
 * @property string|null $sn_cert_entry
 * @property Carbon|null $sn_leaving_date
 * @property Carbon|null $sn_bonafide_date
 * @property Carbon|null $sn_entry_date
 * @property int|null $dis_reason
 * @property string|null $dis_note
 * 
 * @property Collection|AlumniStudent[] $alumni_students
 * @property Collection|ChatUser[] $chat_users
 * @property Collection|ExamGroupClassBatchExam[] $exam_group_class_batch_exams
 * @property Collection|ExamGroup[] $exam_groups
 * @property Collection|LessonPlanForum[] $lesson_plan_forums
 * @property Collection|MultiClassStudent[] $multi_class_students
 *
 * @package App\Models
 */
class Student extends Model
{
	protected $table = 'students';

	protected $casts = [
		'parent_id' => 'int',
		'route_id' => 'int',
		'school_house_id' => 'int',
		'vehroute_id' => 'int',
		'hostel_room_id' => 'int',
		'measurement_date' => 'datetime',
		'disable_at' => 'datetime',
		'online_adm_no' => 'int',
		'sn_leaving_date' => 'datetime',
		'sn_bonafide_date' => 'datetime',
		'sn_entry_date' => 'datetime',
		'dis_reason' => 'int'
	];

	protected $fillable = [
		'parent_id',
		'admission_no',
		'roll_no',
		'exam_seat_no',
		'admission_date',
		'firstname',
		'middlename',
		'lastname',
		'rte',
		'image',
		'mobileno',
		'email',
		'state',
		'city',
		'pincode',
		'religion',
		'cast',
		'subcas',
		'dob',
		'gender',
		'current_address',
		'permanent_address',
		'category_id',
		'route_id',
		'school_house_id',
		'blood_group',
		'vehroute_id',
		'hostel_room_id',
		'adhar_no',
		'samagra_id',
		'bank_account_no',
		'bank_name',
		'ifsc_code',
		'guardian_is',
		'father_name',
		'father_phone',
		'father_occupation',
		'mother_name',
		'mother_phone',
		'mother_occupation',
		'guardian_name',
		'guardian_relation',
		'guardian_phone',
		'guardian_occupation',
		'guardian_address',
		'guardian_email',
		'father_pic',
		'mother_pic',
		'guardian_pic',
		'is_active',
		'previous_school',
		'height',
		'weight',
		'measurement_date',
		'app_key',
		'parent_app_key',
		'disable_at',
		'note',
		'place_of_birth',
		'birth_village',
		'birth_town',
		'birth_taluka',
		'birth_district',
		'father_edu_qualification',
		'mother_edu_qualification',
		'parent_annual_income',
		'number_of_dependent',
		'if_pupil_living_with_parent',
		'nationality',
		'mother_tongue',
		'other_language_spoken',
		'num_of_brother',
		'elder_brother',
		'younger_brother',
		'num_of_sister',
		'elder_sister',
		'younger_sister',
		'if_pupil_produced_last_school_leaving_certificate',
		'date_produced_last_school_leaving_certificate',
		'vaccinations',
		'languages_studied',
		'medium_of_instruction_in_last_school',
		'admission_enquiry_no',
		'reason_of_leaving',
		'date_of_leaving',
		'remarks',
		'prev_school_name',
		'prev_school_scholarship',
		'prev_school_standard_covered',
		'prev_school_tcnumber',
		'prev_school_dateofleaving',
		'prev_school_reasonofleaving',
		'fillbyoffice_admittedto',
		'fillbyoffice_onpaymentfees',
		'fillbyoffice_paymentfeesreceiptno',
		'fillbyoffice_anycomment',
		'academic_preference',
		'academic_conduct',
		'fitness_cert',
		'std_global_id',
		'birth_state',
		'std_board',
		'std_sch_medium',
		'online_adm_no',
		'class_studing_since_when',
		'sn_cert_leaving',
		'sn_cert_bonafide',
		'sn_cert_entry',
		'sn_leaving_date',
		'sn_bonafide_date',
		'sn_entry_date',
		'dis_reason',
		'dis_note'
	];

	public function alumni_students()
	{
		return $this->hasMany(AlumniStudent::class);
	}

	public function chat_users()
	{
		return $this->hasMany(ChatUser::class, 'create_student_id');
	}

	public function exam_group_class_batch_exams()
	{
		return $this->belongsToMany(ExamGroupClassBatchExam::class, 'exam_group_class_batch_exam_students')
					->withPivot('id', 'student_session_id', 'roll_no', 'exam_seat_no', 'teacher_remark', 'is_active')
					->withTimestamps();
	}

	public function exam_groups()
	{
		return $this->belongsToMany(ExamGroup::class, 'exam_group_students')
					->withPivot('id', 'student_session_id', 'is_active')
					->withTimestamps();
	}

	public function lesson_plan_forums()
	{
		return $this->hasMany(LessonPlanForum::class);
	}

	public function multi_class_students()
	{
		return $this->hasMany(MultiClassStudent::class);
	}
}
