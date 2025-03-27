<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CertificateFieldLang
 * 
 * @property int $certfield_lang_id
 * @property int|null $lang_id
 * @property string|null $cert_type
 * @property string|null $serial_no
 * @property string|null $general_register_no
 * @property string|null $school_recognition_no
 * @property string|null $medium
 * @property string|null $udise_no
 * @property string|null $school_code
 * @property string|null $student_id_no
 * @property string|null $uid_aadhar_no
 * @property string|null $full_name_of_student
 * @property string|null $first_name
 * @property string|null $father_name
 * @property string|null $mother_name
 * @property string|null $surname
 * @property string|null $nationality
 * @property string|null $mother_tongue
 * @property string|null $religion
 * @property string|null $cast
 * @property string|null $sub_cast
 * @property string|null $place_of_birth
 * @property string|null $taluka
 * @property string|null $district
 * @property string|null $state
 * @property string|null $nation
 * @property string|null $date_of_birth_figure
 * @property string|null $date_of_birth_word
 * @property string|null $name_of_previous_school_and_Standard
 * @property string|null $date_of_admission_in_this_school
 * @property string|null $class_in_which_studying_since_when
 * @property string|null $academic_preference
 * @property string|null $conduct
 * @property string|null $date_of_leaving_school
 * @property string|null $reason_for_leaving_school
 * @property string|null $remark
 * @property string|null $disclaimer
 * @property string|null $class_teacher
 * @property string|null $clerk
 * @property string|null $principal
 * @property string|null $note
 * @property string|null $data
 * @property int|null $status
 * @property Carbon $created_ts
 * @property Carbon|null $updated_ts
 *
 * @package App\Models
 */
class CertificateFieldLang extends Model
{
	protected $table = 'certificate_field_lang';
	protected $primaryKey = 'certfield_lang_id';
	public $timestamps = false;

	protected $casts = [
		'lang_id' => 'int',
		'status' => 'int',
		'created_ts' => 'datetime',
		'updated_ts' => 'datetime'
	];

	protected $fillable = [
		'lang_id',
		'cert_type',
		'serial_no',
		'general_register_no',
		'school_recognition_no',
		'medium',
		'udise_no',
		'school_code',
		'student_id_no',
		'uid_aadhar_no',
		'full_name_of_student',
		'first_name',
		'father_name',
		'mother_name',
		'surname',
		'nationality',
		'mother_tongue',
		'religion',
		'cast',
		'sub_cast',
		'place_of_birth',
		'taluka',
		'district',
		'state',
		'nation',
		'date_of_birth_figure',
		'date_of_birth_word',
		'name_of_previous_school_and_Standard',
		'date_of_admission_in_this_school',
		'class_in_which_studying_since_when',
		'academic_preference',
		'conduct',
		'date_of_leaving_school',
		'reason_for_leaving_school',
		'remark',
		'disclaimer',
		'class_teacher',
		'clerk',
		'principal',
		'note',
		'data',
		'status',
		'created_ts',
		'updated_ts'
	];
}
