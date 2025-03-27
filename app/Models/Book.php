<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 * 
 * @property int $id
 * @property string $book_title
 * @property string $book_no
 * @property string $isbn_no
 * @property string|null $subject
 * @property string $rack_no
 * @property string|null $publish
 * @property string|null $author
 * @property int|null $qty
 * @property float|null $perunitcost
 * @property Carbon|null $postdate
 * @property string|null $description
 * @property string|null $available
 * @property string|null $is_active
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Book extends Model
{
	protected $table = 'books';

	protected $casts = [
		'qty' => 'int',
		'perunitcost' => 'float',
		'postdate' => 'datetime'
	];

	protected $fillable = [
		'book_title',
		'book_no',
		'isbn_no',
		'subject',
		'rack_no',
		'publish',
		'author',
		'qty',
		'perunitcost',
		'postdate',
		'description',
		'available',
		'is_active'
	];
}
