<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VisitorsBook
 * 
 * @property int $id
 * @property string|null $source
 * @property string $purpose
 * @property string $name
 * @property string|null $email
 * @property string $contact
 * @property string $id_proof
 * @property int $no_of_pepple
 * @property Carbon $date
 * @property string $in_time
 * @property string $out_time
 * @property string $note
 * @property string $image
 *
 * @package App\Models
 */
class VisitorsBook extends Model
{
	protected $table = 'visitors_book';
	public $timestamps = false;

	protected $casts = [
		'no_of_pepple' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'source',
		'purpose',
		'name',
		'email',
		'contact',
		'id_proof',
		'no_of_pepple',
		'date',
		'in_time',
		'out_time',
		'note',
		'image'
	];
}
