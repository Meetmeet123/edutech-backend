<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TemplateMarksheet
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
 * @property string|null $left_sign
 * @property string|null $middle_sign
 * @property string|null $right_sign
 * @property int|null $exam_session
 * @property int|null $is_name
 * @property int|null $is_father_name
 * @property int|null $is_mother_name
 * @property int|null $is_dob
 * @property int|null $is_admission_no
 * @property int|null $is_roll_no
 * @property int|null $is_photo
 * @property int $is_division
 * @property int $is_customfield
 * @property string|null $background_img
 * @property string|null $date
 * @property int $is_class
 * @property int $is_teacher_remark
 * @property int $is_section
 * @property string|null $content
 * @property string|null $content_footer
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TemplateMarksheet extends Model
{
	protected $table = 'template_marksheets';

	protected $casts = [
		'exam_session' => 'int',
		'is_name' => 'int',
		'is_father_name' => 'int',
		'is_mother_name' => 'int',
		'is_dob' => 'int',
		'is_admission_no' => 'int',
		'is_roll_no' => 'int',
		'is_photo' => 'int',
		'is_division' => 'int',
		'is_customfield' => 'int',
		'is_class' => 'int',
		'is_teacher_remark' => 'int',
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
		'left_sign',
		'middle_sign',
		'right_sign',
		'exam_session',
		'is_name',
		'is_father_name',
		'is_mother_name',
		'is_dob',
		'is_admission_no',
		'is_roll_no',
		'is_photo',
		'is_division',
		'is_customfield',
		'background_img',
		'date',
		'is_class',
		'is_teacher_remark',
		'is_section',
		'content',
		'content_footer'
	];
}
