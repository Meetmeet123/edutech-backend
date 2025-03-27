<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GenratedCertificate
 * 
 * @property int $id
 * @property int $student_id
 * @property string $certificate_type
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class GenratedCertificate extends Model
{
	protected $table = 'genrated_certificates';
	public $timestamps = false;

	protected $casts = [
		'student_id' => 'int'
	];

	protected $fillable = [
		'student_id',
		'certificate_type'
	];
}
