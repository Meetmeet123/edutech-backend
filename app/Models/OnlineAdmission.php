<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OnlineAdmission
 * 
 * @property int $id
 * @property string|null $admission_no
 * @property string|null $roll_no
 * @property string $reference_no
 * @property Carbon|null $admission_date
 * @property string|null $firstname
 * @property string $middlename
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
 * @property Carbon|null $dob
 * @property string|null $gender
 * @property string|null $current_address
 * @property string|null $permanent_address
 * @property int|null $category_id
 * @property int|null $class_section_id
 * @property int|null $std_classid
 * @property int $route_id
 * @property int|null $school_house_id
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
 * @property int|null $is_enroll
 * @property string|null $previous_school
 * @property string $height
 * @property string $weight
 * @property string $note
 * @property int $form_status
 * @property int $paid_status
 * @property Carbon|null $measurement_date
 * @property string|null $app_key
 * @property string|null $document
 * @property string|null $status
 * @property string|null $cancel_reason
 * @property string|null $reg_fname
 * @property string|null $reg_midname
 * @property string|null $reg_lname
 * @property string|null $reg_uname
 * @property string|null $reg_pass
 * @property string|null $reg_email
 * @property string|null $reg_mobile
 * @property string|null $birth_place
 * @property string|null $birth_taluka
 * @property string|null $birth_district
 * @property string|null $sub_caste
 * @property string|null $marital_status
 * @property string|null $corr_address_line
 * @property string|null $corr_address_taluka
 * @property string|null $corr_address_district
 * @property string|null $corr_address_pincode
 * @property string|null $mother_tongue
 * @property string|null $hobbies
 * @property string|null $sport_participation
 * @property string|null $sport_level
 * @property string|null $identification_mark
 * @property string|null $join_nss
 * @property string|null $apply_to_hostel
 * @property string|null $in_electorlist
 * @property string|null $student_sign
 * @property string|null $prev_exam_class
 * @property string|null $prev_exam_yop
 * @property string|null $prev_exam_seatno
 * @property string|null $prev_exam_noattemp
 * @property string|null $prev_exam_board
 * @property string|null $prev_exam_subjects
 * @property string|null $prev_exam_markobtained
 * @property string|null $prev_exam_percentage
 * @property string|null $prev_exam_division
 * @property string|null $som_12th_grad_copy
 * @property string|null $som_prevyr_copy
 * @property string|null $leavecert_copy
 * @property string|null $castecert_copy
 * @property string|null $gapcert_copy
 * @property string|null $migratecert_copy
 * @property string|null $phyhandcert_copy
 * @property string|null $aadharphoto_copy
 * @property Carbon $disable_at
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ClassSection|null $class_section
 * @property Collection|GatewayIn[] $gateway_ins
 *
 * @package App\Models
 */
class OnlineAdmission extends Model
{
	protected $table = 'online_admissions';

	protected $casts = [
		'admission_date' => 'datetime',
		'dob' => 'datetime',
		'category_id' => 'int',
		'class_section_id' => 'int',
		'std_classid' => 'int',
		'route_id' => 'int',
		'school_house_id' => 'int',
		'vehroute_id' => 'int',
		'hostel_room_id' => 'int',
		'is_enroll' => 'int',
		'form_status' => 'int',
		'paid_status' => 'int',
		'measurement_date' => 'datetime',
		'disable_at' => 'datetime'
	];

	protected $fillable = [
		'admission_no',
		'roll_no',
		'reference_no',
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
		'dob',
		'gender',
		'current_address',
		'permanent_address',
		'category_id',
		'class_section_id',
		'std_classid',
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
		'is_enroll',
		'previous_school',
		'height',
		'weight',
		'note',
		'form_status',
		'paid_status',
		'measurement_date',
		'app_key',
		'document',
		'status',
		'cancel_reason',
		'reg_fname',
		'reg_midname',
		'reg_lname',
		'reg_uname',
		'reg_pass',
		'reg_email',
		'reg_mobile',
		'birth_place',
		'birth_taluka',
		'birth_district',
		'sub_caste',
		'marital_status',
		'corr_address_line',
		'corr_address_taluka',
		'corr_address_district',
		'corr_address_pincode',
		'mother_tongue',
		'hobbies',
		'sport_participation',
		'sport_level',
		'identification_mark',
		'join_nss',
		'apply_to_hostel',
		'in_electorlist',
		'student_sign',
		'prev_exam_class',
		'prev_exam_yop',
		'prev_exam_seatno',
		'prev_exam_noattemp',
		'prev_exam_board',
		'prev_exam_subjects',
		'prev_exam_markobtained',
		'prev_exam_percentage',
		'prev_exam_division',
		'som_12th_grad_copy',
		'som_prevyr_copy',
		'leavecert_copy',
		'castecert_copy',
		'gapcert_copy',
		'migratecert_copy',
		'phyhandcert_copy',
		'aadharphoto_copy',
		'disable_at'
	];

	public function class_section()
	{
		return $this->belongsTo(ClassSection::class);
	}

	public function gateway_ins()
	{
		return $this->hasMany(GatewayIn::class);
	}
}
