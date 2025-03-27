<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamMarkDistributionComponent
 * 
 * @property int $id
 * @property int|null $mdtid
 * @property string|null $name
 * @property string|null $description
 * @property int|null $status
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ExamMarkDistributionComponent extends Model
{
	protected $table = 'exam_mark_distribution_component';

	protected $casts = [
		'mdtid' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'mdtid',
		'name',
		'description',
		'status'
	];
}
