<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Certificate
 * 
 * @property int $id
 * @property string $certificate_name
 * @property string $certificate_text
 * @property string $left_header
 * @property string $center_header
 * @property string $right_header
 * @property string $left_footer
 * @property string $right_footer
 * @property string $center_footer
 * @property string $background_image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property bool $created_for
 * @property bool $status
 * @property int $header_height
 * @property int $content_height
 * @property int $footer_height
 * @property int $content_width
 * @property bool $enable_student_image
 * @property int $enable_image_height
 *
 * @package App\Models
 */
class Certificate extends Model
{
	protected $table = 'certificates';

	protected $casts = [
		'created_for' => 'bool',
		'status' => 'bool',
		'header_height' => 'int',
		'content_height' => 'int',
		'footer_height' => 'int',
		'content_width' => 'int',
		'enable_student_image' => 'bool',
		'enable_image_height' => 'int'
	];

	protected $fillable = [
		'certificate_name',
		'certificate_text',
		'left_header',
		'center_header',
		'right_header',
		'left_footer',
		'right_footer',
		'center_footer',
		'background_image',
		'created_for',
		'status',
		'header_height',
		'content_height',
		'footer_height',
		'content_width',
		'enable_student_image',
		'enable_image_height'
	];
}
