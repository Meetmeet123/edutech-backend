<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SchSetting;
use App\Models\ExamGroup;
use App\Models\BatchSubject;
use App\Models\ClassModel;
use App\Models\Session;
use App\Models\ExamGroupStudent;
use App\Models\Subject;
use App\Models\FeeDiscount;
use App\Models\SubjectTimetable;
use App\Models\ExamStudent;
use App\Models\ExamSubject;
use App\Models\SubjectGroup;
use App\Models\ExamMarksDistributionType;
use App\Models\ExamMarkDistributionComponent;
use App\Models\ExamSubjectwiseRemark;
use App\Models\ExamClasswiseSubjectsMark;
use App\Models\ExamClassSubjectsComponent;
use App\Models\ExamScorecardComponent;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use App\Services\MailSmsService;
use App\Libraries\EncodingLib;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExamPatternController extends Controller
{

    // Initialize exam_type with a default array of valid types
    protected $exam_type = [
        'school_exam' => 'School Exam',
        'college_exam' => 'College Exam',
        'mock_test' => 'Mock Test'
    ];

    protected $sch_current_session;
    protected $attendence_exam;
    protected $sch_setting_detail;
    protected $encoding_lib;
    protected $mailsmsconf;

    public function exportFormat()
    {
        return response()->download(storage_path('app/backend/import/import_marks_sample_file.csv'), 'import_marks_sample_file.csv');
    }

    public function uploadFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $file = $request->file('file');
        $return_array = [];

        if (($handle = fopen($file->getRealPath(), 'r')) !== false) {
            $flag = true;
            while (($column = fgetcsv($handle, 10000, ',')) !== false) {
                if ($flag) {
                    $flag = false;
                    continue;
                }
                if (trim($column[0]) && trim($column[1]) && trim($column[2])) {
                    $return_array[] = [
                        'adm_no' => $column[0],
                        'attendence' => $column[1],
                        'marks' => number_format($column[2], 2, '.', ''),
                        'note' => $this->encoding_lib->toUTF8($column[3] ?? ''),
                    ];
                }
            }
            fclose($handle);
        }

        return response()->json(['status' => 1, 'error' => '', 'student_marks' => $return_array]);
    }

    public function index(Request $request)
    {
        // Use the initialized $exam_type, with a fallback to empty array if needed
        $exam_types = $this->exam_type ?? [];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'exam_type' => 'required|string|in:' . implode(',', array_keys($exam_types)),
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            $examGroup = ExamGroup::create([
                'name' => $request->name,
                'exam_type' => $request->exam_type,
                'is_active' => 0,
                'description' => $request->description,
            ]);

            return response()->json(['status' => 1, 'message' => __('success_message')]);
        }

        return response()->json([
            'title' => 'Add Batch',
            'title_list' => 'Recent Batch',
            'examType' => $exam_types,
            'examgrouplist' => ExamGroup::all(),
        ]);
    }

    public function getExamByExamGroup(Request $request)
    {
        $exam_group_id = $request->exam_group_id;
        $data = ExamGroup::where('id', $exam_group_id)
            ->where('is_active', 1)
            ->get();
        return response()->json($data);
    }

    public function deleteExam(Request $request)
    {
        $id = $request->id;
        if (!ExamGroup::deleteExam($id)) {
            return response()->json(['status' => 0, 'message' => __('something_wrong')]);
        }
        return response()->json(['status' => 1, 'message' => __('record_deleted_successfully')]);
    }

    public function exam($id)
    {
        return response()->json([
            'examgroupDetail' => ExamGroup::findOrFail($id),
            'exam_subjects' => BatchSubject::getExamSubjects($id),
            'classlist' => ClassModel::all(),
            'sessionlist' => Session::all(),
            'current_session' => $this->sch_current_session,
        ]);
    }

    public function examResult($id, Request $request)
    {
        $data = ['id' => $id, 'classlist' => ClassModel::all()];

        if ($request->isMethod('post')) {
            $data['class_id'] = $request->class_id;
            $data['batch_id'] = $request->batch_id;
            $data['exam_group_class_batch_exam_subject_id'] = $request->exam_group_class_batch_exam_subject_id;
            $data['exam_subjects'] = BatchSubject::getExamSubjects($id);
            $data['resultlist'] = BatchSubject::examGroupExamResult($request->class_id, $request->batch_id, $id);
        }

        return response()->json($data);
    }

    public function addMark($id, Request $request)
    {
        $data = [
            'exam_subjects' => BatchSubject::getExamSubjects($id),
            'id' => $id,
            'classlist' => ClassModel::all(),
            'sessionlist' => Session::all(),
        ];

        if ($request->isMethod('post')) {
            $data['exam_group_class_batch_exam_subject_id'] = $request->exam_group_class_batch_exam_subject_id;
            $data['class_id'] = $request->class_id;
            $data['section_id'] = $request->section_id;
            $data['session_id'] = $request->session_id;
            $data['resultlist'] = ExamGroupStudent::examGroupSubjectResult(
                $request->exam_group_class_batch_exam_subject_id,
                $request->class_id,
                $request->section_id,
                $request->session_id
            );
            $data['subject_detail'] = BatchSubject::getExamSubject($request->exam_group_class_batch_exam_subject_id);
            $data['attendence_exam'] = $this->attendence_exam;
        }

        return response()->json($data);
    }

    public function delete($id)
    {
        Gate::authorize('delete', 'exam_group');
        ExamGroup::destroy($id);
        return response()->json(['status' => 1, 'message' => __('record_deleted_successfully')]);
    }

    public function edit($id, Request $request)
    {
        Gate::authorize('edit', 'exam');

        // Use the initialized $exam_type
        $exam_types = $this->exam_type ?? [];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            ExamGroup::findOrFail($id)->update([
                'name' => $request->name,
                'exam_type' => $request->exam_type,
                'is_active' => 0,
                'description' => $request->description,
            ]);

            return response()->json(['status' => 1, 'message' => __('update_message')]);
        }

        return response()->json([
            'id' => $id,
            'examgroup' => ExamGroup::findOrFail($id),
            'examType' => $exam_types,
            'examgrouplist' => ExamGroup::all(),
        ]);
    }

    public function getByClassSection(Request $request)
    {
        $section_id = $request->section_id;
        $data = ExamGroup::getStudentBatch($section_id);
        return response()->json($data);
    }

    public function addExam($id)
    {
        Gate::authorize('view', 'exam');

        return response()->json([
            'title' => 'Add Batch',
            'title_list' => 'Recent Batch',
            'classlist' => ClassModel::all(),
            'examType' => $this->exam_type ?? [],
            'sessionlist' => Session::all(),
            'subjectlist' => Subject::all(),
            'current_session' => $this->sch_current_session,
            'examgroup' => ExamGroup::findOrFail($id),
        ]);
    }

    public function getNotAppliedDiscount($student_session_id)
    {
        return response()->json(FeeDiscount::getDiscountNotApplied($student_session_id));
    }

    public function subjectStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|integer',
            'section_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'session_id' => 'required|integer',
        ]);

        $userdata = auth()->user();
        $can_edit = 1;
        if ($userdata->role_id == 2 && $userdata->class_teacher == 'yes') {
            $can_edit = SubjectTimetable::canAddExamMarks(
                $userdata->id,
                $request->class_id,
                $request->section_id,
                $request->teachersubject_id
            );
        }

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        } elseif (!$can_edit) {
            return response()->json(['status' => 0, 'error' => ['lesson' => __('not_authoried')]]);
        }

        $data = [
            'exam_group_class_batch_exam_subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'session_id' => $request->session_id,
            'resultlist' => ExamGroupStudent::examGroupSubjectResult(
                $request->subject_id,
                $request->class_id,
                $request->section_id,
                $request->session_id
            ),
            'subject_detail' => BatchSubject::getExamSubject($request->subject_id),
            'attendence_exam' => $this->attendence_exam,
            'sch_setting' => $this->sch_setting_detail,
        ];

        return response()->json(['status' => 1, 'error' => '', 'data' => $data]);
    }

    public function examStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|integer',
            'section_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $data = [
            'adm_auto_insert' => $this->sch_setting_detail->adm_auto_insert,
            'sch_setting' => $this->sch_setting_detail,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'exam_id' => $request->exam_id,
            'resultlist' => ExamStudent::searchExamStudents($request->class_id, $request->section_id, $request->exam_id),
        ];

        return response()->json(['status' => 1, 'error' => '', 'data' => $data]);
    }

    public function ajaxAddExam(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exam' => 'required|string|max:255',
            'session_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $exam_id = $request->exam_id ?? 0;
        $is_active = $request->has('is_active') ? 1 : 0;
        $is_publish = $request->has('is_publish') ? 1 : 0;

        $data = [
            'exam' => $request->exam,
            'exam_group_id' => $request->exam_group_id,
            'session_id' => $request->session_id,
            'is_active' => $is_active,
            'is_publish' => $is_publish,
            'description' => $request->description,
            'use_exam_roll_no' => $request->use_exam_roll_no,
        ];

        if ($exam_id) {
            ExamGroup::findOrFail($exam_id)->update($data);
            $message = __('update_message');
        } else {
            $exam = ExamGroup::create($data);
            $exam_id = $exam->id;
            $message = __('success_message');
        }

        if ($is_publish) {
            $exam_data = ExamGroup::find($exam_id);
            $exam_students = ExamGroupStudent::searchExamStudentsByExam($exam_id);
            $this->mailsmsconf->mailsms('exam_result', ['exam' => $exam_data, 'exam_result' => $exam_students]);
        }

        return response()->json(['status' => 1, 'error' => '', 'message' => $message]);
    }

    public function getExamsByExamGroup(Request $request)
    {
        $exam_group_id = $request->exam_group_id;
        $exams = ExamGroup::getExamByExamGroup($exam_group_id, true);
        return response()->json(['status' => 1, 'error' => '', 'result' => $exams]);
    }

    public function entryMarks(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exam_group_class_batch_exam_subject_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $exam_group_student_ids = $request->exam_group_student_id ?? [];
        $insert_array = [];

        foreach ($exam_group_student_ids as $student_id) {
            $attendance = $request->input("exam_group_student_attendance_{$student_id}", 'present');
            $insert_array[] = [
                'exam_group_class_batch_exam_subject_id' => $request->exam_group_class_batch_exam_subject_id,
                'exam_group_class_batch_exam_student_id' => $student_id,
                'attendence' => $attendance,
                'get_marks' => $request->input("exam_group_student_mark_{$student_id}"),
                'note' => $request->input("exam_group_student_note_{$student_id}"),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        ExamGroupStudent::insert($insert_array);
        return response()->json(['status' => 1, 'error' => '', 'message' => __('success_message')]);
    }

    public function getExam(Request $request)
    {
        $examgroup_id = $request->examgroup_id;
        $examList = ExamGroup::getExamByExamGroup($examgroup_id);
        return response()->json(['examList' => $examList]);
    }

    public function connectExams(Request $request)
    {
        $examgroup_id = $request->examgroup_id;
        $examList = ExamGroup::getExamByExamGroupConnection($examgroup_id);
        return response()->json(['examList' => $examList, 'examgroup_id' => $examgroup_id]);
    }

    public function getExamById(Request $request)
    {
        $exam_id = $request->exam_id;
        $result = ExamGroup::find($exam_id);
        if ($result) {
            $result->date_from = Carbon::parse($result->date_from)->format('Y-m-d');
            $result->date_to = Carbon::parse($result->date_to)->format('Y-m-d');
        }
        return response()->json(['exam' => $result]);
    }

    public function getExamSubjects(Request $request)
    {
        $exam_id = $request->exam_id;
        $data = [
            'examgroupDetail' => ExamGroup::findOrFail($exam_id),
            'exam_subjects' => BatchSubject::getExamSubjects($exam_id),
            'batch_subjects' => Subject::all(),
            'exam_id' => $exam_id,
            'exam_subjects_count' => BatchSubject::getExamSubjects($exam_id)->count(),
        ];
        return response()->json($data);
    }

    public function getSubjectByExam(Request $request)
    {
        $id = $request->recordid;
        $data = [
            'examgroupDetail' => ExamGroup::findOrFail($id),
            'exam_subjects' => BatchSubject::getExamSubjects($id),
            'classlist' => ClassModel::all(),
            'sessionlist' => Session::all(),
            'current_session' => $this->sch_current_session,
        ];
        return response()->json($data);
    }

    public function getTeacherRemarkByExam(Request $request)
    {
        $id = $request->recordid;
        $data = [
            'examgroupDetail' => ExamGroup::findOrFail($id),
            'examgroupStudents' => ExamGroupStudent::searchExamStudentsByExam($id),
            'sch_setting' => $this->sch_setting_detail,
        ];
        return response()->json($data);
    }

    public function addExamSubject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'examgroup_id' => 'required|integer',
            'exam_group_class_batch_exam_id' => 'required|integer',
            'rows' => 'required|array',
            'rows.*' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $insert_array = [];
        $update_array = [];
        $not_be_del = [];

        foreach ($request->rows as $row_value) {
            $update_id = $request->input("prev_row.{$row_value}", 0);
            $subject_data = [
                'exam_group_class_batch_exams_id' => $request->exam_group_class_batch_exam_id,
                'subject_id' => $request->input("subject_{$row_value}"),
                'credit_hours' => $request->input("credit_hours{$row_value}"),
                'date_from' => Carbon::createFromFormat('Y-m-d', $request->input("date_from_{$row_value}")),
                'time_from' => $request->input("time_from{$row_value}"),
                'duration' => $request->input("duration{$row_value}"),
                'room_no' => $request->input("room_no_{$row_value}"),
                'max_marks' => $request->input("max_marks_{$row_value}"),
                'min_marks' => $request->input("min_marks_{$row_value}"),
            ];

            if ($update_id == 0 && !empty(array_filter($subject_data))) {
                $insert_array[] = $subject_data;
            } else {
                $not_be_del[] = $update_id;
                $subject_data['id'] = $update_id;
                $update_array[] = $subject_data;
            }
        }

        ExamSubject::add($insert_array, $update_array, $not_be_del, $request->exam_group_class_batch_exam_id);
        return response()->json(['status' => 1, 'error' => '', 'message' => __('success_message')]);
    }

    public function assign($id, Request $request)
    {
        Gate::authorize('view', 'fees_group_assign');

        $data = [
            'id' => $id,
            'title' => 'student fees',
            'classlist' => ClassModel::all(),
            'examgroup' => ExamGroup::getExamGroupDetailByID($id),
            'sessionlist' => Session::all(),
        ];

        if ($request->isMethod('post')) {
            $data['class_id'] = $request->class_id;
            $data['section_id'] = $request->section_id;
            $data['session_id'] = $request->session_id;
            $data['examgroup_id'] = $request->examgroup_id;
            $data['resultlist'] = ExamGroupStudent::searchExamGroupStudents(
                $request->examgroup_id,
                $request->class_id,
                $request->section_id,
                $request->session_id
            );
        }

        return response()->json($data);
    }

    public function addStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exam_group' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'error' => $validator->errors()]);
        }

        $students_id = $request->students_id ?? [];
        $all_students = $request->all_students ?? [];
        $exam_group = $request->exam_group;
        $insert_array = [];
        $delete_array = [];

        foreach ($all_students as $student_value) {
            if (in_array($student_value, $students_id)) {
                $insert_array[] = [
                    'exam_group_id' => $exam_group,
                    'student_id' => $student_value,
                    'student_session_id' => $student_value,
                ];
            } else {
                $delete_array[] = $student_value;
            }
        }

        ExamGroupStudent::add($insert_array, $delete_array, $exam_group);
        return response()->json(['status' => 'success', 'error' => '', 'message' => __('success_message')]);
    }

    public function ajaxConnectForm(Request $request)
    {
        if ($request->action == 'reset') {
            ExamGroup::deleteExamGroupConnection($request->examgroup_id);
            return response()->json(['status' => 1, 'error' => '', 'message' => __('update_message')]);
        } elseif ($request->action == 'save') {
            $validator = Validator::make($request->all(), [
                'examgroup_id' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            $exam_array = $request->input('exam', []);
            if (empty($exam_array)) {
                return response()->json(['status' => 0, 'error' => '', 'message' => __('no_exams_selected')]);
            }

            if (count($exam_array) <= 1) {
                return response()->json(['status' => 0, 'error' => '', 'message' => __('please_select_atleast_two_or_more_exams')]);
            }

            $exam_group = ExamGroup::verifyExamConnection($exam_array);
            if ($exam_group['no_record']) {
                if (count($exam_group['exam_subject_array']) != count($exam_array)) {
                    return response()->json(['status' => 0, 'error' => '', 'message' => __('please_check_exam_subjects')]);
                }

                $insert_success = true;
                $result = key($exam_group['exam_subject_array']);
                foreach ($exam_group['exam_subject_array'] as $exam_subject_key => $exam_subject_value) {
                    $compair_result = $this->compareMultiArrays($exam_group['exam_subject_array'][$result], $exam_subject_value);
                    if ($compair_result && (!empty($compair_result['more']) || !empty($compair_result['less']) || !empty($compair_result['diff']))) {
                        $insert_success = false;
                        break;
                    }
                }

                if ($insert_success) {
                    $insert_array = [];
                    foreach ($exam_array as $exam_value) {
                        $insert_array[] = [
                            'exam_group_id' => $request->examgroup_id,
                            'exam_group_class_batch_exams_id' => $exam_value,
                            'exam_weightage' => $request->input("exam_{$exam_value}"),
                        ];
                    }
                    ExamGroup::connectExam($insert_array, $request->examgroup_id);
                    return response()->json(['status' => 1, 'error' => '', 'message' => __('exam_connected_successfully')]);
                }
            }

            return response()->json(['status' => 0, 'error' => '', 'message' => __('exams_subject_may_be_empty_please_check_exam_subjects')]);
        }
    }

    private function compareMultiArrays($array1, $array2)
    {
        if (empty($array1) || empty($array2)) {
            return false;
        }

        $result = ['more' => [], 'less' => [], 'diff' => []];
        foreach ($array1 as $k => $v) {
            if (is_array($v) && isset($array2[$k]) && is_array($array2[$k])) {
                $sub_result = $this->compareMultiArrays($v, $array2[$k]);
                foreach ($sub_result as $key => $value) {
                    if (!empty($value)) {
                        $result[$key] = array_merge_recursive($result[$key], [$k => $value]);
                    }
                }
            } else {
                if (isset($array2[$k])) {
                    if ($v !== $array2[$k]) {
                        $result['diff'][$k] = ['from' => $v, 'to' => $array2[$k]];
                    }
                } else {
                    $result['more'][$k] = $v;
                }
            }
        }
        foreach ($array2 as $k => $v) {
            if (!isset($array1[$k])) {
                $result['less'][$k] = $v;
            }
        }
        return $result;
    }

    public function getExamGroupByClassSection(Request $request)
    {
        $exam_group = ExamGroup::getExamGroupByClassSection($request->class_id, $request->section_id, $request->session_id);
        return response()->json(['status' => 1, 'exam_group' => $exam_group]);
    }

    public function entryStudents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exam_group_class_batch_exam_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $student_session = $request->student_session_id ?? [];
        $all_students = $request->all_students ?? [];
        $insert_array = [];

        foreach ($student_session as $student_value) {
            $insert_array[] = [
                'exam_group_class_batch_exam_id' => $request->exam_group_class_batch_exam_id,
                'student_id' => $request->input("student_{$student_value}"),
                'student_session_id' => $student_value,
            ];
        }

        ExamStudent::addStudent($insert_array, $request->exam_group_class_batch_exam_id, $all_students);
        return response()->json(['status' => 1, 'error' => '', 'message' => __('success_message')]);
    }

    public function saveExamRemark(Request $request)
    {
        $students = $request->exam_group_class_batch_exam_student ?? [];
        $batch_update_array = [];

        foreach ($students as $student_value) {
            $batch_update_array[] = [
                'id' => $student_value,
                'teacher_remark' => $request->input("remark_{$student_value}"),
            ];
        }

        if (!empty($batch_update_array)) {
            ExamGroupStudent::updateExamStudent($batch_update_array);
        }

        return response()->json(['status' => 1, 'error' => '', 'message' => __('success_message')]);
    }

    public function marksDistributionType(Request $request)
    {
        Gate::authorize('view', 'exam_group');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            ExamMarksDistributionType::create([
                'name' => $request->name,
                'status' => 1,
                'description' => $request->description,
            ]);

            return response()->json(['status' => 1, 'message' => __('success_message')]);
        }

        return response()->json([
            'title' => 'Add Batch',
            'title_list' => 'Recent Batch',
            'examType' => $this->exam_type,
            'examgrouplist' => ExamMarksDistributionType::where('status', 1)->orderBy('id', 'asc')->get(),
        ]);
    }

    public function editMarksDistributionType($id, Request $request)
    {
        Gate::authorize('edit', 'exam');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            ExamMarksDistributionType::findOrFail($id)->update([
                'name' => $request->name,
                'status' => 1,
                'description' => $request->description,
            ]);

            return response()->json(['status' => 1, 'message' => __('update_message')]);
        }

        return response()->json([
            'id' => $id,
            'examgroup' => ExamMarksDistributionType::findOrFail($id),
            'examType' => $this->exam_type,
            'examgrouplist' => ExamMarksDistributionType::where('status', 1)->orderBy('id', 'asc')->get(),
        ]);
    }

    public function deleteMarksDistributionType($id)
    {
        Gate::authorize('delete', 'exam_group');
        ExamMarksDistributionType::findOrFail($id)->update(['status' => 3]);
        return response()->json(['status' => 1, 'message' => __('record_deleted_successfully')]);
    }

    public function marksDistributionComponent(Request $request)
    {
        Gate::authorize('view', 'exam_group');

        $validator = Validator::make($request->all(), [
            'mark_dist_type' => 'required|integer',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            if ($request->has('name') && !empty($request->name)) {
                foreach ($request->name as $comp_name) {
                    ExamMarkDistributionComponent::create([
                        'name' => $comp_name,
                        'mdtid' => $request->mark_dist_type,
                        'status' => 1,
                        'description' => $request->description,
                    ]);
                }
                return response()->json(['status' => 1, 'message' => __('success_message')]);
            }
        }

        return response()->json([
            'title' => 'Add Batch',
            'title_list' => 'Recent Batch',
            'examType' => $this->exam_type,
            'examgrouplist' => ExamMarkDistributionComponent::where('status', 1)->orderBy('id', 'asc')->get(),
            'marks_dist_types' => ExamMarksDistributionType::where('status', 1)->orderBy('id', 'asc')->get(),
        ]);
    }

    public function editMarksDistributionComponent($id, Request $request)
    {
        Gate::authorize('edit', 'exam');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mark_dist_type' => 'required|integer',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            ExamMarkDistributionComponent::findOrFail($id)->update([
                'mdtid' => $request->mark_dist_type,
                'name' => $request->name,
                'status' => 1,
                'description' => $request->description,
            ]);

            return response()->json(['status' => 1, 'message' => __('update_message')]);
        }

        return response()->json([
            'id' => $id,
            'examgroup' => ExamMarkDistributionComponent::findOrFail($id),
            'examType' => $this->exam_type,
            'examgrouplist' => ExamMarkDistributionComponent::where('status', 1)->orderBy('id', 'asc')->get(),
            'marks_dist_types' => ExamMarksDistributionType::where('status', 1)->orderBy('id', 'asc')->get(),
        ]);
    }

    public function deleteMarksDistributionComponent($id)
    {
        Gate::authorize('delete', 'exam_group');
        ExamMarkDistributionComponent::findOrFail($id)->update(['status' => 3]);
        return response()->json(['status' => 1, 'message' => __('record_deleted_successfully')]);
    }

    public function subjectwiseRemark(Request $request)
    {
        Gate::authorize('view', 'exam_group');

        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|integer',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            if ($request->has('name') && !empty($request->name)) {
                foreach ($request->name as $comp_name) {
                    ExamSubjectwiseRemark::create([
                        'remark_name' => $comp_name,
                        'subject_id' => $request->subject_id,
                        'status' => 1,
                        'note' => $request->description,
                    ]);
                }
                return response()->json(['status' => 1, 'message' => __('success_message')]);
            }
        }

        return response()->json([
            'title' => 'Add Batch',
            'title_list' => 'Recent Batch',
            'examType' => $this->exam_type,
            'examgrouplist' => ExamSubjectwiseRemark::where('status', 1)->orderBy('id', 'asc')->get(),
            'subjects' => Subject::orderBy('id', 'asc')->get(),
        ]);
    }

    public function editSubjectwiseRemark($id, Request $request)
    {
        Gate::authorize('edit', 'exam');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subject_id' => 'required|integer',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            ExamSubjectwiseRemark::findOrFail($id)->update([
                'subject_id' => $request->subject_id,
                'remark_name' => $request->name,
                'status' => 1,
                'note' => $request->description,
            ]);

            return response()->json(['status' => 1, 'message' => __('update_message')]);
        }

        return response()->json([
            'id' => $id,
            'examgroup' => ExamSubjectwiseRemark::findOrFail($id),
            'examType' => $this->exam_type,
            'examgrouplist' => ExamSubjectwiseRemark::where('status', 1)->orderBy('id', 'asc')->get(),
            'subjects' => Subject::orderBy('id', 'asc')->get(),
        ]);
    }

    public function deleteSubjectwiseRemark($id)
    {
        Gate::authorize('delete', 'exam_group');
        ExamSubjectwiseRemark::findOrFail($id)->update(['status' => 3]);
        return response()->json(['status' => 1, 'message' => __('record_deleted_successfully')]);
    }

    public function classwiseSubjectMark(Request $request)
    {
        Gate::authorize('view', 'exam_group');

        $validator = Validator::make($request->all(), [
            'class_id' => 'required|integer',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            if ($request->has('subject_id') && !empty($request->subject_id)) {
                foreach ($request->subject_id as $key => $sub_name) {
                    ExamClasswiseSubjectsMark::create([
                        'class_id' => $request->class_id,
                        'subject_id' => $sub_name,
                        'subject_mark_type' => $request->input("mark_type.{$key}", 0),
                        'max_mark' => $request->input("max_mark.{$key}", 0),
                        'min_mark' => $request->input("min_mark.{$key}", 0),
                        'aakarik_mark' => $request->input("aakarik_mark.{$key}", 0),
                        'sankalit_mark' => $request->input("sankalit_mark.{$key}", 0),
                        'description' => '',
                        'status' => 1,
                    ]);
                }
                return response()->json(['status' => 1, 'message' => __('success_message')]);
            }
            return response()->json(['status' => 0, 'message' => 'Invalid input. Please select subjects and enter marks.']);
        }

        return response()->json([
            'title' => 'Add Batch',
            'title_list' => 'Recent Batch',
            'examType' => $this->exam_type,
            'examgrouplist' => ExamClasswiseSubjectsMark::where('status', 1)->orderBy('id', 'asc')->get(),
            'subjects' => Subject::orderBy('id', 'asc')->get(),
            'classlist' => ClassModel::all(),
            'subjectgroupList' => SubjectGroup::all(),
        ]);
    }

    public function editClasswiseSubjectMark($id, Request $request)
    {
        Gate::authorize('edit', 'exam');

        $validator = Validator::make($request->all(), [
            'class_id' => 'required|integer',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            if ($request->has('subject_id') && !empty($request->subject_id)) {
                foreach ($request->subject_id as $key => $sub_name) {
                    ExamClasswiseSubjectsMark::findOrFail($id)->update([
                        'class_id' => $request->class_id,
                        'subject_id' => $sub_name,
                        'subject_mark_type' => $request->input("mark_type.{$key}", 0),
                        'max_mark' => $request->input("max_mark.{$key}", 0),
                        'min_mark' => $request->input("min_mark.{$key}", 0),
                        'aakarik_mark' => $request->input("aakarik_mark.{$key}", 0),
                        'sankalit_mark' => $request->input("sankalit_mark.{$key}", 0),
                        'description' => '',
                        'status' => 1,
                    ]);
                }
                return response()->json(['status' => 1, 'message' => __('update_message')]);
            }
            return response()->json(['status' => 0, 'message' => 'Invalid input. Please select subject and enter marks.']);
        }

        return response()->json([
            'id' => $id,
            'examgroup' => ExamClasswiseSubjectsMark::findOrFail($id),
            'examType' => $this->exam_type,
            'examgrouplist' => ExamClasswiseSubjectsMark::where('status', 1)->orderBy('id', 'asc')->get(),
            'subjects' => Subject::orderBy('id', 'asc')->get(),
            'classlist' => ClassModel::all(),
            'subjectgroupList' => SubjectGroup::all(),
        ]);
    }

    public function getSubjectByClass(Request $request)
    {
        $class_id = $request->query('class_id');
        $subjectgroupList = SubjectGroup::all();
        $subjects = [];

        foreach ($subjectgroupList as $subgrp) {
            foreach ($subgrp->sections ?? [] as $section) {
                if ($section->class_id == $class_id) {
                    foreach ($subgrp->group_subject ?? [] as $subject) {
                        $subjects[] = [
                            'id' => $subject->subject_id,
                            'name' => "{$subject->name} ({$subject->type})",
                        ];
                    }
                    break;
                }
            }
        }

        return response()->json($subjects);
    }

    public function deleteClasswiseSubjectMark($id)
    {
        Gate::authorize('delete', 'exam_group');
        ExamClasswiseSubjectsMark::findOrFail($id)->update(['status' => 3]);
        return response()->json(['status' => 1, 'message' => __('record_deleted_successfully')]);
    }

    public function classSubjectComponent(Request $request)
    {
        Gate::authorize('view', 'exam_group');

        $validator = Validator::make($request->all(), [
            'class_id' => 'required|integer',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            if ($request->has('mark_dist_comp') && !empty($request->mark_dist_comp)) {
                $existing = ExamClassSubjectsComponent::where('class_id', $request->class_id)
                    ->where('subject_id', $request->subject_id)
                    ->where('status', 1)
                    ->exists();
                if ($existing) {
                    return response()->json(['status' => 0, 'message' => 'The marks distribution is already added for selected class & subject.']);
                }

                $mark_dist_comp = [];
                foreach ($request->mark_dist_comp as $compid) {
                    $mdtid = $mark = 0;
                    if ($request->has("aakcompmark_{$compid}")) {
                        $mdtid = 1;
                        $mark = trim($request->input("aakcompmark_{$compid}"));
                    } elseif ($request->has("sankcompmark_{$compid}")) {
                        $mdtid = 3;
                        $mark = trim($request->input("sankcompmark_{$compid}"));
                    }
                    $mark_dist_comp[] = ['mdtid' => $mdtid, 'mdcid' => $compid, 'mark' => $mark];
                }

                ExamClassSubjectsComponent::create([
                    'class_id' => $request->class_id,
                    'subject_id' => $request->subject_id,
                    'remark_language' => $request->subject_remark_lang ?? '',
                    'mdcid' => json_encode($mark_dist_comp),
                    'status' => 1,
                ]);

                return response()->json(['status' => 1, 'message' => __('success_message')]);
            }
            return response()->json(['status' => 0, 'message' => 'Invalid input. Please select subject and enter distribution marks.']);
        }

        return response()->json([
            'title' => 'Add Batch',
            'title_list' => 'Recent Batch',
            'examType' => $this->exam_type,
            'examgrouplist' => ExamClasswiseSubjectsMark::where('status', 1)->orderBy('id', 'asc')->get(),
            'subjects' => Subject::orderBy('id', 'asc')->get(),
            'classlist' => ClassModel::all(),
            'subjectgroupList' => SubjectGroup::all(),
            'mark_dist_components' => ExamMarkDistributionComponent::where('status', 1)->orderBy('id', 'asc')->get(),
            'mark_subject_components' => ExamClassSubjectsComponent::where('status', 1)->orderBy('id', 'asc')->get(),
        ]);
    }

    public function getClassSubjectMarks(Request $request)
    {
        $examgroup = ExamClasswiseSubjectsMark::where('class_id', $request->query('class_id'))
            ->where('subject_id', $request->query('subject_id'))
            ->where('status', 1)
            ->first();

        if (!$examgroup) {
            return response()->json(['status' => 'fail', 'message' => 'Subject marks not found, please add Subject Marks.']);
        }

        if ($examgroup->subject_mark_type == 2) {
            return response()->json(['status' => 'fail', 'message' => 'Can not add marks distributions for Grade subjects, please select other subject.']);
        }

        $data = [
            'id' => $examgroup->id,
            'class_id' => $examgroup->class_id,
            'subject_id' => $examgroup->subject_id,
            'subject_mark_type' => $examgroup->subject_mark_type,
            'max_mark' => $examgroup->max_mark,
            'min_mark' => $examgroup->min_mark,
            'aakarik_mark' => $examgroup->aakarik_mark,
            'sankalit_mark' => $examgroup->sankalit_mark,
        ];

        return response()->json(['status' => 'success', 'message' => '', 'data' => $data]);
    }

    public function editClassSubjectComponent($id, Request $request)
    {
        Gate::authorize('edit', 'exam');

        $validator = Validator::make($request->all(), [
            'class_id' => 'required|integer',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            if ($request->has('mark_dist_comp') && !empty($request->mark_dist_comp)) {
                $mark_dist_comp = [];
                foreach ($request->mark_dist_comp as $compid) {
                    $mdtid = $mark = 0;
                    if ($request->has("aakcompmark_{$compid}")) {
                        $mdtid = 1;
                        $mark = trim($request->input("aakcompmark_{$compid}"));
                    } elseif ($request->has("sankcompmark_{$compid}")) {
                        $mdtid = 3;
                        $mark = trim($request->input("sankcompmark_{$compid}"));
                    }
                    $mark_dist_comp[] = ['mdtid' => $mdtid, 'mdcid' => $compid, 'mark' => $mark];
                }

                ExamClassSubjectsComponent::findOrFail($id)->update([
                    'class_id' => $request->class_id,
                    'subject_id' => $request->subject_id,
                    'remark_language' => $request->subject_remark_lang ?? '',
                    'mdcid' => json_encode($mark_dist_comp),
                    'status' => 1,
                ]);

                return response()->json(['status' => 1, 'message' => __('update_message')]);
            }
            return response()->json(['status' => 0, 'message' => 'Invalid input. Please select subject and enter distribution marks.']);
        }

        return response()->json([
            'id' => $id,
            'examgroup' => ExamClassSubjectsComponent::findOrFail($id),
            'examType' => $this->exam_type,
            'examgrouplist' => ExamClasswiseSubjectsMark::where('status', 1)->orderBy('id', 'asc')->get(),
            'subjects' => Subject::orderBy('id', 'asc')->get(),
            'classlist' => ClassModel::all(),
            'subjectgroupList' => SubjectGroup::all(),
            'mark_dist_components' => ExamMarkDistributionComponent::where('status', 1)->orderBy('id', 'asc')->get(),
            'mark_subject_components' => ExamClassSubjectsComponent::where('status', 1)->orderBy('id', 'asc')->get(),
        ]);
    }

    public function deleteClassSubjectComponent($id)
    {
        Gate::authorize('delete', 'exam_group');
        ExamClassSubjectsComponent::findOrFail($id)->update(['status' => 3]);
        return response()->json(['status' => 1, 'message' => __('record_deleted_successfully')]);
    }

    public function scorecardComponent(Request $request)
    {
        Gate::authorize('view', 'exam_group');

        $validator = Validator::make($request->all(), [
            'name' => 'required|array',
            'name.*' => 'string|max:255',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            if ($request->has('name') && !empty($request->name)) {
                $selgrades = $request->grades ?? [];
                $selcls = $request->class ?? [];

                foreach ($request->name as $comp_name) {
                    ExamScorecardComponent::create([
                        'component_name' => $comp_name,
                        'subject_mark_grade' => !empty($selgrades) ? json_encode($selgrades) : '',
                        'classes' => !empty($selcls) ? json_encode($selcls) : '',
                        'status' => 1,
                    ]);
                }
                return response()->json(['status' => 1, 'message' => __('success_message')]);
            }
        }

        return response()->json([
            'title' => 'Add Batch',
            'title_list' => 'Recent Batch',
            'examType' => $this->exam_type,
            'examgrouplist' => ExamScorecardComponent::where('status', 1)->orderBy('id', 'asc')->get(),
            'classlist' => ClassModel::all(),
            'grades' => Grade::where('is_active', 'yes')->where('exam_type', 'school_grade_system')->orderBy('id', 'asc')->get(),
        ]);
    }

    public function editScorecardComponent($id, Request $request)
    {
        Gate::authorize('edit', 'exam');

        $validator = Validator::make($request->all(), [
            'name' => 'required|array',
            'name.*' => 'string|max:255',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()]);
            }

            if ($request->has('name') && !empty($request->name)) {
                $selgrades = $request->grades ?? [];
                $selcls = $request->class ?? [];

                foreach ($request->name as $comp_name) {
                    ExamScorecardComponent::findOrFail($id)->update([
                        'component_name' => $comp_name,
                        'subject_mark_grade' => !empty($selgrades) ? json_encode($selgrades) : '',
                        'classes' => !empty($selcls) ? json_encode($selcls) : '',
                        'status' => 1,
                    ]);
                }
                return response()->json(['status' => 1, 'message' => __('update_message')]);
            }
        }

        return response()->json([
            'id' => $id,
            'examgroup' => ExamScorecardComponent::findOrFail($id),
            'examType' => $this->exam_type,
            'examgrouplist' => ExamScorecardComponent::where('status', 1)->orderBy('id', 'asc')->get(),
            'classlist' => ClassModel::all(),
            'grades' => Grade::where('is_active', 'yes')->where('exam_type', 'school_grade_system')->orderBy('id', 'asc')->get(),
        ]);
    }

    public function deleteScorecardComponent($id)
    {
        Gate::authorize('delete', 'exam_group');
        ExamScorecardComponent::findOrFail($id)->update(['status' => 3]);
        return response()->json(['status' => 1, 'message' => __('record_deleted_successfully')]);
    }
}