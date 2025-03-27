<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BookIssue
 * 
 * @property int $id
 * @property int|null $book_id
 * @property Carbon|null $duereturn_date
 * @property Carbon|null $return_date
 * @property Carbon|null $issue_date
 * @property int|null $is_returned
 * @property int|null $member_id
 * @property string $is_active
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class BookIssue extends Model
{
	protected $table = 'book_issues';
	public $timestamps = false;

	protected $casts = [
		'book_id' => 'int',
		'duereturn_date' => 'datetime',
		'return_date' => 'datetime',
		'issue_date' => 'datetime',
		'is_returned' => 'int',
		'member_id' => 'int'
	];

	protected $fillable = [
		'book_id',
		'duereturn_date',
		'return_date',
		'issue_date',
		'is_returned',
		'member_id',
		'is_active'
	];
}
