<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class IdCard
 * 
 * @property int $id
 * @property string $title
 * @property string $school_name
 * @property string $school_address
 * @property string $background
 * @property string $logo
 * @property string $sign_image
 * @property int $enable_vertical_card
 * @property string $header_color
 * @property bool $enable_admission_no
 * @property bool $enable_student_name
 * @property bool $enable_class
 * @property bool $enable_fathers_name
 * @property bool $enable_mothers_name
 * @property bool $enable_address
 * @property bool $enable_phone
 * @property bool $enable_dob
 * @property bool $enable_blood_group
 * @property bool $status
 *
 * @package App\Models
 */
class IdCard extends Model
{
	protected $table = 'id_card';
	public $timestamps = false;

	protected $casts = [
		'enable_vertical_card' => 'int',
		'enable_admission_no' => 'bool',
		'enable_student_name' => 'bool',
		'enable_class' => 'bool',
		'enable_fathers_name' => 'bool',
		'enable_mothers_name' => 'bool',
		'enable_address' => 'bool',
		'enable_phone' => 'bool',
		'enable_dob' => 'bool',
		'enable_blood_group' => 'bool',
		'status' => 'bool'
	];

	protected $fillable = [
		'title',
		'school_name',
		'school_address',
		'background',
		'logo',
		'sign_image',
		'enable_vertical_card',
		'header_color',
		'enable_admission_no',
		'enable_student_name',
		'enable_class',
		'enable_fathers_name',
		'enable_mothers_name',
		'enable_address',
		'enable_phone',
		'enable_dob',
		'enable_blood_group',
		'status'
	];
}
