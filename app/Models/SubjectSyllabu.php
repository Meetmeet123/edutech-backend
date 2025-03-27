<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubjectSyllabu
 * 
 * @property int $id
 * @property int $topic_id
 * @property int $session_id
 * @property int $created_by
 * @property int $created_for
 * @property Carbon $date
 * @property string $time_from
 * @property string $time_to
 * @property string $presentation
 * @property string $attachment
 * @property string $lacture_youtube_url
 * @property string $lacture_video
 * @property string $sub_topic
 * @property string $teaching_method
 * @property string $general_objectives
 * @property string $previous_knowledge
 * @property string $comprehensive_questions
 * @property int $status
 * @property Carbon $created_at
 * 
 * @property Collection|LessonPlanForum[] $lesson_plan_forums
 *
 * @package App\Models
 */
class SubjectSyllabu extends Model
{
	protected $table = 'subject_syllabus';
	public $timestamps = false;

	protected $casts = [
		'topic_id' => 'int',
		'session_id' => 'int',
		'created_by' => 'int',
		'created_for' => 'int',
		'date' => 'datetime',
		'status' => 'int'
	];

	protected $fillable = [
		'topic_id',
		'session_id',
		'created_by',
		'created_for',
		'date',
		'time_from',
		'time_to',
		'presentation',
		'attachment',
		'lacture_youtube_url',
		'lacture_video',
		'sub_topic',
		'teaching_method',
		'general_objectives',
		'previous_knowledge',
		'comprehensive_questions',
		'status'
	];

	public function lesson_plan_forums()
	{
		return $this->hasMany(LessonPlanForum::class, 'subject_syllabus_id');
	}
}
