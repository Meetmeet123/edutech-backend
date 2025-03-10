<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\ExamGroupClassBatchExam;

class ExamGroup extends Model
{
    protected $fillable = ['name', 'exam_type', 'is_active', 'description'];

    public function get($id = null)
    {
        if ($id) {
            return $this->withCount('examGroupClassBatchExams as counter')->find($id);
        }
        return $this->withCount('examGroupClassBatchExams as counter')->orderBy('id')->get();
    }

    public function examGroupClassBatchExams()
    {
        return $this->hasMany(ExamGroupClassBatchExam::class, 'exam_group_id');
    }

    public function getExamByID($id)
    {
        return DB::table('exam_group_class_batch_exams')
            ->select('exam_groups.name as exam_group_name', 'exam_groups.exam_type as exam_group_type', 'exam_groups.id as exam_group_id', 'exam_group_class_batch_exams.*', 'sessions.session')
            ->join('exam_groups', 'exam_groups.id', '=', 'exam_group_class_batch_exams.exam_group_id')
            ->join('sessions', 'sessions.id', '=', 'exam_group_class_batch_exams.session_id')
            ->where('exam_group_class_batch_exams.id', $id)
            ->first();
    }

    public function remove($id)
    {
        DB::beginTransaction();
        try {
            $this->find($id)->delete();
            // Log the deletion (implement your logging logic here)
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function add($data)
    {
        DB::beginTransaction();
        try {
            if (isset($data['id'])) {
                $this->where('id', $data['id'])->update($data);
                // Log update
            } else {
                $examGroup = $this->create($data);
                // Log insert
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    // Add other methods as needed, converting CodeIgniter queries to Laravel Eloquent or Query Builder
}