<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Staff
 * 
 * @property int $id
 * @property string $employee_id
 * @property int $lang_id
 * @property int|null $department
 * @property int|null $designation
 * @property string $qualification
 * @property string $work_exp
 * @property string $name
 * @property string $surname
 * @property string $father_name
 * @property string $mother_name
 * @property string $contact_no
 * @property string $emergency_contact_no
 * @property string $email
 * @property Carbon $dob
 * @property string|null $anniversary_date
 * @property string $marital_status
 * @property Carbon $date_of_joining
 * @property Carbon $date_of_leaving
 * @property string $local_address
 * @property string $permanent_address
 * @property string $note
 * @property string $image
 * @property string $password
 * @property string $gender
 * @property string $account_title
 * @property string $bank_account_no
 * @property string $bank_name
 * @property string $ifsc_code
 * @property string $bank_branch
 * @property string $payscale
 * @property string $basic_salary
 * @property string $epf_no
 * @property string $contract_type
 * @property string $shift
 * @property string $location
 * @property string $facebook
 * @property string $twitter
 * @property string $linkedin
 * @property string $instagram
 * @property string $resume
 * @property string $joining_letter
 * @property string $resignation_letter
 * @property string $other_document_name
 * @property string $other_document_file
 * @property int $user_id
 * @property int $is_active
 * @property string $verification_code
 * @property Carbon|null $disable_at
 * @property string|null $middlename
 * @property string|null $primarysubject
 * @property string|null $noofsons
 * @property string|null $noofdughters
 * @property string|null $blood_group
 * 
 * @property Collection|ChatUser[] $chat_users
 * @property Collection|DailyAssignment[] $daily_assignments
 * @property Collection|LessonPlanForum[] $lesson_plan_forums
 * @property Collection|OfflineFeesPayment[] $offline_fees_payments
 * @property Collection|ShareContent[] $share_contents
 *
 * @package App\Models
 */
class Staff extends Model
{
	protected $table = 'staff';
	public $timestamps = false;

	protected $casts = [
		'lang_id' => 'int',
		'department' => 'int',
		'designation' => 'int',
		'dob' => 'datetime',
		'date_of_joining' => 'datetime',
		'date_of_leaving' => 'datetime',
		'user_id' => 'int',
		'is_active' => 'int',
		'disable_at' => 'datetime'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'employee_id',
		'lang_id',
		'department',
		'designation',
		'qualification',
		'work_exp',
		'name',
		'surname',
		'father_name',
		'mother_name',
		'contact_no',
		'emergency_contact_no',
		'email',
		'dob',
		'anniversary_date',
		'marital_status',
		'date_of_joining',
		'date_of_leaving',
		'local_address',
		'permanent_address',
		'note',
		'image',
		'password',
		'gender',
		'account_title',
		'bank_account_no',
		'bank_name',
		'ifsc_code',
		'bank_branch',
		'payscale',
		'basic_salary',
		'epf_no',
		'contract_type',
		'shift',
		'location',
		'facebook',
		'twitter',
		'linkedin',
		'instagram',
		'resume',
		'joining_letter',
		'resignation_letter',
		'other_document_name',
		'other_document_file',
		'user_id',
		'is_active',
		'verification_code',
		'disable_at',
		'middlename',
		'primarysubject',
		'noofsons',
		'noofdughters',
		'blood_group'
	];

	public function chat_users()
	{
		return $this->hasMany(ChatUser::class, 'create_staff_id');
	}

	public function daily_assignments()
	{
		return $this->hasMany(DailyAssignment::class, 'evaluated_by');
	}

	public function lesson_plan_forums()
	{
		return $this->hasMany(LessonPlanForum::class);
	}

	public function offline_fees_payments()
	{
		return $this->hasMany(OfflineFeesPayment::class, 'approved_by');
	}

	public function share_contents()
	{
		return $this->hasMany(ShareContent::class, 'created_by');
	}
}
