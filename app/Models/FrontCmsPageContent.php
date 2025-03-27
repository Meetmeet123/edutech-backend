<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FrontCmsPageContent
 * 
 * @property int $id
 * @property int|null $page_id
 * @property string|null $content_type
 * @property Carbon $created_at
 * 
 * @property FrontCmsPage|null $front_cms_page
 *
 * @package App\Models
 */
class FrontCmsPageContent extends Model
{
	protected $table = 'front_cms_page_contents';
	public $timestamps = false;

	protected $casts = [
		'page_id' => 'int'
	];

	protected $fillable = [
		'page_id',
		'content_type'
	];

	public function front_cms_page()
	{
		return $this->belongsTo(FrontCmsPage::class, 'page_id');
	}
}
