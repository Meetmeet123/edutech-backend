<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StaffIdCard
 * 
 * @property int $id
 * @property string $title
 * @property string $school_name
 * @property string $school_address
 * @property string $background
 * @property string $logo
 * @property string $sign_image
 * @property string $header_color
 * @property int $enable_vertical_card
 * @property bool $enable_staff_role
 * @property bool $enable_staff_id
 * @property bool $enable_staff_department
 * @property bool $enable_designation
 * @property bool $enable_name
 * @property bool $enable_fathers_name
 * @property bool $enable_mothers_name
 * @property bool $enable_date_of_joining
 * @property bool $enable_permanent_address
 * @property bool $enable_staff_dob
 * @property bool $enable_staff_phone
 * @property bool $status
 *
 * @package App\Models
 */
class StaffIdCard extends Model
{
	protected $table = 'staff_id_card';
	public $timestamps = false;

	protected $casts = [
		'enable_vertical_card' => 'int',
		'enable_staff_role' => 'bool',
		'enable_staff_id' => 'bool',
		'enable_staff_department' => 'bool',
		'enable_designation' => 'bool',
		'enable_name' => 'bool',
		'enable_fathers_name' => 'bool',
		'enable_mothers_name' => 'bool',
		'enable_date_of_joining' => 'bool',
		'enable_permanent_address' => 'bool',
		'enable_staff_dob' => 'bool',
		'enable_staff_phone' => 'bool',
		'status' => 'bool'
	];

	protected $fillable = [
		'title',
		'school_name',
		'school_address',
		'background',
		'logo',
		'sign_image',
		'header_color',
		'enable_vertical_card',
		'enable_staff_role',
		'enable_staff_id',
		'enable_staff_department',
		'enable_designation',
		'enable_name',
		'enable_fathers_name',
		'enable_mothers_name',
		'enable_date_of_joining',
		'enable_permanent_address',
		'enable_staff_dob',
		'enable_staff_phone',
		'status'
	];
}
