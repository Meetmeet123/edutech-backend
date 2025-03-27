<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentDoc
 * 
 * @property int $id
 * @property int|null $student_id
 * @property string|null $title
 * @property string|null $doc
 *
 * @package App\Models
 */
class StudentDoc extends Model
{
	protected $table = 'student_doc';
	public $timestamps = false;

	protected $casts = [
		'student_id' => 'int'
	];

	protected $fillable = [
		'student_id',
		'title',
		'doc'
	];
}
