<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FrontCmsSetting
 * 
 * @property int $id
 * @property string|null $theme
 * @property int|null $is_active_rtl
 * @property int|null $is_active_front_cms
 * @property int|null $is_active_sidebar
 * @property string|null $logo
 * @property string|null $contact_us_email
 * @property string|null $complain_form_email
 * @property string $sidebar_options
 * @property string $whatsapp_url
 * @property string $fb_url
 * @property string $twitter_url
 * @property string $youtube_url
 * @property string $google_plus
 * @property string $instagram_url
 * @property string $pinterest_url
 * @property string $linkedin_url
 * @property string|null $google_analytics
 * @property string|null $footer_text
 * @property string $cookie_consent
 * @property string|null $fav_icon
 * @property string|null $adm_app_form
 * @property string|null $inst_broucher
 * @property string|null $inst_leaflet
 * @property string|null $inst_maxine
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class FrontCmsSetting extends Model
{
	protected $table = 'front_cms_settings';
	public $timestamps = false;

	protected $casts = [
		'is_active_rtl' => 'int',
		'is_active_front_cms' => 'int',
		'is_active_sidebar' => 'int'
	];

	protected $fillable = [
		'theme',
		'is_active_rtl',
		'is_active_front_cms',
		'is_active_sidebar',
		'logo',
		'contact_us_email',
		'complain_form_email',
		'sidebar_options',
		'whatsapp_url',
		'fb_url',
		'twitter_url',
		'youtube_url',
		'google_plus',
		'instagram_url',
		'pinterest_url',
		'linkedin_url',
		'google_analytics',
		'footer_text',
		'cookie_consent',
		'fav_icon',
		'adm_app_form',
		'inst_broucher',
		'inst_leaflet',
		'inst_maxine'
	];
}
