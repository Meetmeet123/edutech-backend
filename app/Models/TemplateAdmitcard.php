<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TemplateAdmitcard
 * 
 * @property int $id
 * @property string|null $template
 * @property string|null $heading
 * @property string|null $title
 * @property string|null $left_logo
 * @property string|null $right_logo
 * @property string|null $exam_name
 * @property string|null $school_name
 * @property string|null $exam_center
 * @property string|null $sign
 * @property string|null $background_img
 * @property int $is_name
 * @property int $is_father_name
 * @property int $is_mother_name
 * @property int $is_dob
 * @property int $is_admission_no
 * @property int $is_roll_no
 * @property int $is_address
 * @property int $is_gender
 * @property int $is_photo
 * @property int $is_class
 * @property int $is_section
 * @property string|null $content_footer
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TemplateAdmitcard extends Model
{
	protected $table = 'template_admitcards';

	protected $casts = [
		'is_name' => 'int',
		'is_father_name' => 'int',
		'is_mother_name' => 'int',
		'is_dob' => 'int',
		'is_admission_no' => 'int',
		'is_roll_no' => 'int',
		'is_address' => 'int',
		'is_gender' => 'int',
		'is_photo' => 'int',
		'is_class' => 'int',
		'is_section' => 'int'
	];

	protected $fillable = [
		'template',
		'heading',
		'title',
		'left_logo',
		'right_logo',
		'exam_name',
		'school_name',
		'exam_center',
		'sign',
		'background_img',
		'is_name',
		'is_father_name',
		'is_mother_name',
		'is_dob',
		'is_admission_no',
		'is_roll_no',
		'is_address',
		'is_gender',
		'is_photo',
		'is_class',
		'is_section',
		'content_footer'
	];
}
