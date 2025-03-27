<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SchSetting
 * 
 * @property int $id
 * @property string|null $name
 * @property int|null $biometric
 * @property string|null $biometric_device
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property int|null $lang_id
 * @property string $languages
 * @property string|null $dise_code
 * @property string $date_format
 * @property string $time_format
 * @property string $currency
 * @property string $currency_symbol
 * @property string|null $is_rtl
 * @property int|null $is_duplicate_fees_invoice
 * @property string|null $timezone
 * @property int|null $session_id
 * @property string $cron_secret_key
 * @property string $currency_place
 * @property string $class_teacher
 * @property string $start_month
 * @property int $attendence_type
 * @property string|null $image
 * @property string $admin_logo
 * @property string $admin_small_logo
 * @property string $theme
 * @property int|null $fee_due_days
 * @property int $adm_auto_insert
 * @property string $adm_prefix
 * @property string $adm_start_from
 * @property int $adm_no_digit
 * @property int $adm_update_status
 * @property int $staffid_auto_insert
 * @property string $staffid_prefix
 * @property string $staffid_start_from
 * @property int $staffid_no_digit
 * @property int $staffid_update_status
 * @property string|null $is_active
 * @property int|null $online_admission
 * @property string $online_admission_payment
 * @property float $online_admission_amount
 * @property string $online_admission_instruction
 * @property string $online_admission_conditions
 * @property int $is_blood_group
 * @property int $is_student_house
 * @property int $roll_no
 * @property int $category
 * @property int $religion
 * @property int $cast
 * @property int $mobile_no
 * @property int $student_email
 * @property int $admission_date
 * @property int $lastname
 * @property int $middlename
 * @property int $student_photo
 * @property int $student_height
 * @property int $student_weight
 * @property int $measurement_date
 * @property int $father_name
 * @property int $father_phone
 * @property int $father_occupation
 * @property int $father_pic
 * @property int $mother_name
 * @property int $mother_phone
 * @property int $mother_occupation
 * @property int $mother_pic
 * @property int $guardian_name
 * @property int $guardian_relation
 * @property int $guardian_phone
 * @property int $guardian_email
 * @property int $guardian_pic
 * @property int $guardian_occupation
 * @property int $guardian_address
 * @property int $current_address
 * @property int $permanent_address
 * @property int $route_list
 * @property int $hostel_id
 * @property int $bank_account_no
 * @property int $ifsc_code
 * @property int $bank_name
 * @property int $national_identification_no
 * @property int $local_identification_no
 * @property int $rte
 * @property int $previous_school_details
 * @property int $student_note
 * @property int $upload_documents
 * @property int $staff_designation
 * @property int $staff_department
 * @property int $staff_last_name
 * @property int $staff_father_name
 * @property int $staff_mother_name
 * @property int $staff_date_of_joining
 * @property int $staff_phone
 * @property int $staff_emergency_contact
 * @property int $staff_marital_status
 * @property int $staff_photo
 * @property int $staff_current_address
 * @property int $staff_permanent_address
 * @property int $staff_qualification
 * @property int $staff_work_experience
 * @property int $staff_note
 * @property int $staff_epf_no
 * @property int $staff_basic_salary
 * @property int $staff_contract_type
 * @property int $staff_work_shift
 * @property int $staff_work_location
 * @property int $staff_leaves
 * @property int $staff_account_details
 * @property int $staff_social_media
 * @property int $staff_upload_documents
 * @property string $mobile_api_url
 * @property string|null $app_primary_color_code
 * @property string|null $app_secondary_color_code
 * @property string|null $app_logo
 * @property int $student_profile_edit
 * @property string $start_week
 * @property int $my_question
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $sch_name_primary
 * @property string|null $sch_name_secondary
 * @property string|null $sch_recog_primary
 * @property string|null $sch_recog_secondary
 * @property string|null $sch_udise_primary
 * @property string|null $sch_udise_secondary
 * @property string|null $sch_city
 * @property string|null $sch_state
 * @property string|null $sch_medium
 * @property string|null $sch_board
 * @property string|null $principal_sign
 * @property string|null $clerk_sign
 * @property string|null $examiner_sign
 * @property string|null $est_year
 * @property string|null $alt_phone_no
 * @property string|null $alt_email_id
 * @property string|null $sch_name_high_secondary
 * @property string|null $sch_recog_high_secondary
 * @property string|null $sch_udise_high_secondary
 * @property string|null $sch_society_name
 * @property string|null $certificate_logo
 * @property string|null $system_name
 * @property string|null $cert_leave_auto_insert
 * @property string|null $cert_leave_prefix
 * @property string|null $cert_leave_start_from
 * @property string|null $cert_leave_no_digit
 * @property string|null $cert_leave_update_status
 * @property string|null $cert_bona_auto_insert
 * @property string|null $cert_bona_prefix
 * @property string|null $cert_bona_start_from
 * @property string|null $cert_bona_no_digit
 * @property string|null $cert_bona_update_status
 * @property string|null $cert_entry_auto_insert
 * @property string|null $cert_entry_prefix
 * @property string|null $cert_entry_start_from
 * @property string|null $cert_entry_no_digit
 * @property string|null $cert_entry_update_status
 * @property int|null $certificate_print_lang
 * @property string|null $birth_place
 * @property string|null $birth_taluka
 * @property string|null $birth_district
 * @property string|null $sub_caste
 * @property string|null $marital_status
 * @property string|null $correspondence address
 * @property string|null $prev_exam_details
 * @property string|null $student_sign
 * @property string|null $mother_tongue
 * @property string|null $join_nss
 * @property string|null $apply_to_hostel
 * @property string|null $hobbies
 * @property string|null $sport_participation
 * @property string|null $sport_level
 * @property string|null $identification_mark
 * @property string|null $in_electorlist
 * @property string|null $vat_no
 * @property string|null $cin_no
 * @property string|null $service_tax_no
 * @property string|null $pan_number
 * @property string|null $gst_no
 *
 * @package App\Models
 */
class SchSetting extends Model
{
	protected $table = 'sch_settings';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'biometric' => 'int',
		'lang_id' => 'int',
		'is_duplicate_fees_invoice' => 'int',
		'session_id' => 'int',
		'attendence_type' => 'int',
		'fee_due_days' => 'int',
		'adm_auto_insert' => 'int',
		'adm_no_digit' => 'int',
		'adm_update_status' => 'int',
		'staffid_auto_insert' => 'int',
		'staffid_no_digit' => 'int',
		'staffid_update_status' => 'int',
		'online_admission' => 'int',
		'online_admission_amount' => 'float',
		'is_blood_group' => 'int',
		'is_student_house' => 'int',
		'roll_no' => 'int',
		'category' => 'int',
		'religion' => 'int',
		'cast' => 'int',
		'mobile_no' => 'int',
		'student_email' => 'int',
		'admission_date' => 'int',
		'lastname' => 'int',
		'middlename' => 'int',
		'student_photo' => 'int',
		'student_height' => 'int',
		'student_weight' => 'int',
		'measurement_date' => 'int',
		'father_name' => 'int',
		'father_phone' => 'int',
		'father_occupation' => 'int',
		'father_pic' => 'int',
		'mother_name' => 'int',
		'mother_phone' => 'int',
		'mother_occupation' => 'int',
		'mother_pic' => 'int',
		'guardian_name' => 'int',
		'guardian_relation' => 'int',
		'guardian_phone' => 'int',
		'guardian_email' => 'int',
		'guardian_pic' => 'int',
		'guardian_occupation' => 'int',
		'guardian_address' => 'int',
		'current_address' => 'int',
		'permanent_address' => 'int',
		'route_list' => 'int',
		'hostel_id' => 'int',
		'bank_account_no' => 'int',
		'ifsc_code' => 'int',
		'bank_name' => 'int',
		'national_identification_no' => 'int',
		'local_identification_no' => 'int',
		'rte' => 'int',
		'previous_school_details' => 'int',
		'student_note' => 'int',
		'upload_documents' => 'int',
		'staff_designation' => 'int',
		'staff_department' => 'int',
		'staff_last_name' => 'int',
		'staff_father_name' => 'int',
		'staff_mother_name' => 'int',
		'staff_date_of_joining' => 'int',
		'staff_phone' => 'int',
		'staff_emergency_contact' => 'int',
		'staff_marital_status' => 'int',
		'staff_photo' => 'int',
		'staff_current_address' => 'int',
		'staff_permanent_address' => 'int',
		'staff_qualification' => 'int',
		'staff_work_experience' => 'int',
		'staff_note' => 'int',
		'staff_epf_no' => 'int',
		'staff_basic_salary' => 'int',
		'staff_contract_type' => 'int',
		'staff_work_shift' => 'int',
		'staff_work_location' => 'int',
		'staff_leaves' => 'int',
		'staff_account_details' => 'int',
		'staff_social_media' => 'int',
		'staff_upload_documents' => 'int',
		'student_profile_edit' => 'int',
		'my_question' => 'int',
		'certificate_print_lang' => 'int'
	];

	protected $hidden = [
		'cron_secret_key'
	];

	protected $fillable = [
		'name',
		'biometric',
		'biometric_device',
		'email',
		'phone',
		'address',
		'lang_id',
		'languages',
		'dise_code',
		'date_format',
		'time_format',
		'currency',
		'currency_symbol',
		'is_rtl',
		'is_duplicate_fees_invoice',
		'timezone',
		'session_id',
		'cron_secret_key',
		'currency_place',
		'class_teacher',
		'start_month',
		'attendence_type',
		'image',
		'admin_logo',
		'admin_small_logo',
		'theme',
		'fee_due_days',
		'adm_auto_insert',
		'adm_prefix',
		'adm_start_from',
		'adm_no_digit',
		'adm_update_status',
		'staffid_auto_insert',
		'staffid_prefix',
		'staffid_start_from',
		'staffid_no_digit',
		'staffid_update_status',
		'is_active',
		'online_admission',
		'online_admission_payment',
		'online_admission_amount',
		'online_admission_instruction',
		'online_admission_conditions',
		'is_blood_group',
		'is_student_house',
		'roll_no',
		'category',
		'religion',
		'cast',
		'mobile_no',
		'student_email',
		'admission_date',
		'lastname',
		'middlename',
		'student_photo',
		'student_height',
		'student_weight',
		'measurement_date',
		'father_name',
		'father_phone',
		'father_occupation',
		'father_pic',
		'mother_name',
		'mother_phone',
		'mother_occupation',
		'mother_pic',
		'guardian_name',
		'guardian_relation',
		'guardian_phone',
		'guardian_email',
		'guardian_pic',
		'guardian_occupation',
		'guardian_address',
		'current_address',
		'permanent_address',
		'route_list',
		'hostel_id',
		'bank_account_no',
		'ifsc_code',
		'bank_name',
		'national_identification_no',
		'local_identification_no',
		'rte',
		'previous_school_details',
		'student_note',
		'upload_documents',
		'staff_designation',
		'staff_department',
		'staff_last_name',
		'staff_father_name',
		'staff_mother_name',
		'staff_date_of_joining',
		'staff_phone',
		'staff_emergency_contact',
		'staff_marital_status',
		'staff_photo',
		'staff_current_address',
		'staff_permanent_address',
		'staff_qualification',
		'staff_work_experience',
		'staff_note',
		'staff_epf_no',
		'staff_basic_salary',
		'staff_contract_type',
		'staff_work_shift',
		'staff_work_location',
		'staff_leaves',
		'staff_account_details',
		'staff_social_media',
		'staff_upload_documents',
		'mobile_api_url',
		'app_primary_color_code',
		'app_secondary_color_code',
		'app_logo',
		'student_profile_edit',
		'start_week',
		'my_question',
		'sch_name_primary',
		'sch_name_secondary',
		'sch_recog_primary',
		'sch_recog_secondary',
		'sch_udise_primary',
		'sch_udise_secondary',
		'sch_city',
		'sch_state',
		'sch_medium',
		'sch_board',
		'principal_sign',
		'clerk_sign',
		'examiner_sign',
		'est_year',
		'alt_phone_no',
		'alt_email_id',
		'sch_name_high_secondary',
		'sch_recog_high_secondary',
		'sch_udise_high_secondary',
		'sch_society_name',
		'certificate_logo',
		'system_name',
		'cert_leave_auto_insert',
		'cert_leave_prefix',
		'cert_leave_start_from',
		'cert_leave_no_digit',
		'cert_leave_update_status',
		'cert_bona_auto_insert',
		'cert_bona_prefix',
		'cert_bona_start_from',
		'cert_bona_no_digit',
		'cert_bona_update_status',
		'cert_entry_auto_insert',
		'cert_entry_prefix',
		'cert_entry_start_from',
		'cert_entry_no_digit',
		'cert_entry_update_status',
		'certificate_print_lang',
		'birth_place',
		'birth_taluka',
		'birth_district',
		'sub_caste',
		'marital_status',
		'correspondence address',
		'prev_exam_details',
		'student_sign',
		'mother_tongue',
		'join_nss',
		'apply_to_hostel',
		'hobbies',
		'sport_participation',
		'sport_level',
		'identification_mark',
		'in_electorlist',
		'vat_no',
		'cin_no',
		'service_tax_no',
		'pan_number',
		'gst_no'
	];
}
