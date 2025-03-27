<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\ExamMarksDistributionType;
use App\Models\ExamMarkDistributionComponent;
use App\Models\ExamSubjectwiseRemark;
use App\Models\ExamClasswiseSubjectsMark;
use App\Models\ExamClassSubjectsComponent;
use App\Models\ExamScorecardComponent;
use App\Models\Classes as ClassModel; // Assuming Class model
use App\Models\Subject;   // Assuming Subject model
use App\Models\SubjectGroup; // Assuming SubjectGroup model
use App\Models\Grade;     // Assuming Grade model
use App\Models\ExamGroup; // Assuming ExamGroup model
use App\Models\Exam;      // Assuming Exam model

class ExamPatternController extends Controller
{
    private $exam_type;
    private $sch_current_session;

    public function __construct()
    {
        $this->exam_type = config('exam_type'); // Fetch from config
        $this->sch_current_session = $this->getCurrentSession(); // Replace with actual logic
    }

    private function getCurrentSession()
    {
        return 1; // Placeholder; fetch from settings or database
    }

    // API to export sample CSV file
    public function exportFormat()
    {
        $filePath = storage_path('app/backend/import/import_marks_sample_file.csv');
        return Response::download($filePath, 'import_marks_sample_file.csv');
    }

    // API to upload and process CSV file
    public function uploadFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        $file = $request->file('file');
        $returnArray = [];

        if ($file && $file->getSize() > 0) {
            $csv = array_map('str_getcsv', file($file->getPathname()));
            array_shift($csv); // Skip header row

            foreach ($csv as $row) {
                if (trim($row[0]) && trim($row[1]) && trim($row[2])) {
                    $returnArray[] = json_encode([
                        'adm_no' => $row[0],
                        'attendence' => $row[1],
                        'marks' => number_format($row[2], 2, '.', ''),
                        'note' => mb_convert_encoding($row[3], 'UTF-8', 'auto'),
                    ]);
                }
            }

            return response()->json(['status' => 1, 'error' => '', 'student_marks' => $returnArray]);
        }

        return response()->json(['status' => 0, 'error' => ['file' => 'Please choose a file to upload.']], 422);
    }

    // API to list exam groups (index)
    public function index()
    {
        // Commented out auth check
        // if (!auth()->user()->can('exam_group.view')) {
        //     return response()->json(['error' => 'Access denied'], 403);
        // }

        $examGroups = ExamGroup::all();
        return response()->json(['status' => 1, 'examgrouplist' => $examGroups, 'examType' => $this->exam_type]);
    }

    // API to store a new exam group
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'exam_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        $examGroup = ExamGroup::create([
            'name' => $request->input('name'),
            'exam_type' => $request->input('exam_type'),
            'is_active' => 0,
            'description' => $request->input('description'),
        ]);

        return response()->json(['status' => 1, 'message' => __('Success message'), 'exam_group_id' => $examGroup->id]);
    }

    // API to get exams by exam group (without BatchSubject)
    public function getExamByExamgroup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exam_group_id' => 'required|exists:exam_groups,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        $examGroupId = $request->input('exam_group_id');
        $data = Exam::where('is_active', true)->get();

        if ($data->isEmpty()) {
            return response()->json([
                'status' => 1,
                'message' => 'No active exams found for this group (exam_group_id not supported in current schema)',
                'data' => []
            ]);
        }

        return response()->json($data);
    }

    // API to delete an exam group
    public function deleteExamGroup(Request $request)
    {
        // Commented out auth check
        // if (!auth()->user()->can('exam_group.delete')) {
        //     return response()->json(['error' => 'Access denied'], 403);
        // }

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:exam_groups,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        ExamGroup::destroy($request->input('id'));
        return response()->json(['status' => 1, 'message' => __('Record deleted successfully')]);
    }

    // API to delete an exam
    public function deleteExam(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:exams,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        $success = Exam::destroy($request->input('id'));
        return response()->json([
            'status' => $success ? 1 : 0,
            'message' => $success ? __('Record deleted successfully') : __('Something wrong')
        ]);
    }

    // API to get exam details by ID (without BatchSubject)
    public function getExamDetails($id)
    {
        $examGroupDetail = ExamGroup::findOrFail($id);
        // Replace BatchSubject logic with ExamClasswiseSubjectsMark or similar
        $examSubjects = ExamClasswiseSubjectsMark::where('status', 1)->get();
        $classes = ClassModel::all();

        return response()->json([
            'status' => 1,
            'examgroupDetail' => $examGroupDetail,
            'exam_subjects' => $examSubjects,
            'classlist' => $classes,
            'current_session' => $this->sch_current_session
        ]);
    }

    // API to get exam results (without BatchSubject)
    public function getExamResult($id)
    {
        $classes = ClassModel::all();
        $data = ['id' => $id, 'classlist' => $classes];

        return response()->json(['status' => 1, 'data' => $data]);
    }

    // API to post exam results (without BatchSubject)
    public function postExamResult(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'exam_group_class_batch_exam_subject_id' => 'required',
            'class_id' => 'required|exists:classes,id',
            'batch_id' => 'required', // Assuming batch_id is passed but not tied to BatchSubject
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        // Replace BatchSubject logic with ExamClasswiseSubjectsMark or custom query
        $examSubjects = ExamClasswiseSubjectsMark::where('class_id', $request->input('class_id'))
            ->where('status', 1)
            ->get();

        // Simulate result list logic without BatchSubject
        $resultList = ExamClasswiseSubjectsMark::where('class_id', $request->input('class_id'))
            ->where('status', 1)
            ->get();

        return response()->json([
            'status' => 1,
            'exam_subjects' => $examSubjects,
            'resultlist' => $resultList,
            'class_id' => $request->input('class_id'),
            'batch_id' => $request->input('batch_id'),
            'exam_group_class_batch_exam_subject_id' => $request->input('exam_group_class_batch_exam_subject_id')
        ]);
    }

    // API to list marks distribution types
    public function marksDistributionTypeList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($request->isMethod('post') && $validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        if ($request->isMethod('post')) {
            $data = [
                'name' => $request->input('name'),
                'status' => 1,
                'description' => $request->input('description'),
            ];
            ExamMarksDistributionType::create($data);

            return response()->json(['status' => 1, 'message' => __('Success message')]);
        }

        $examGroups = ExamMarksDistributionType::where('status', 1)->orderBy('id', 'asc')->get();
        return response()->json(['status' => 1, 'examgrouplist' => $examGroups, 'examType' => $this->exam_type]);
    }

    // API to edit marks distribution type
    public function editMarksDistributionType(Request $request, $id)
    {
        $examGroup = ExamMarksDistributionType::findOrFail($id);
        $examGroups = ExamMarksDistributionType::where('status', 1)->orderBy('id', 'asc')->get();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
            }

            $examGroup->update([
                'name' => $request->input('name'),
                'status' => 1,
                'description' => $request->input('description'),
            ]);

            return response()->json(['status' => 1, 'message' => __('Update message')]);
        }

        return response()->json(['status' => 1, 'examgroup' => $examGroup, 'examgrouplist' => $examGroups, 'examType' => $this->exam_type]);
    }

    // API to delete marks distribution type
    public function deleteMarksDistributionType($id)
    {
        ExamMarksDistributionType::where('id', $id)->update(['status' => 3]);
        return response()->json(['status' => 1, 'message' => __('Record deleted successfully')]);
    }

    // API to list marks distribution components
    public function marksDistributionComponentList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mark_dist_type' => 'required|exists:exam_marks_distribution_type,id',
        ]);

        if ($request->isMethod('post') && $validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        if ($request->isMethod('post')) {
            $names = $request->input('name', []);
            foreach ($names as $name) {
                ExamMarkDistributionComponent::create([
                    'name' => $name,
                    'mdtid' => $request->input('mark_dist_type'),
                    'status' => 1,
                    'description' => $request->input('description'),
                ]);
            }
            return response()->json(['status' => 1, 'message' => __('Success message')]);
        }

        $examGroups = ExamMarkDistributionComponent::where('status', 1)->orderBy('id', 'asc')->get();
        $marksDistTypes = ExamMarksDistributionType::where('status', 1)->orderBy('id', 'asc')->get();
        return response()->json(['status' => 1, 'examgrouplist' => $examGroups, 'marks_dist_types' => $marksDistTypes, 'examType' => $this->exam_type]);
    }

    // API to edit marks distribution component
    public function editMarksDistributionComponent(Request $request, $id)
    {
        $examGroup = ExamMarkDistributionComponent::findOrFail($id);
        $examGroups = ExamMarkDistributionComponent::where('status', 1)->orderBy('id', 'asc')->get();
        $marksDistTypes = ExamMarksDistributionType::where('status', 1)->orderBy('id', 'asc')->get();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mark_dist_type' => 'required|exists:exam_marks_distribution_type,id',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
            }

            $examGroup->update([
                'name' => $request->input('name'),
                'mdtid' => $request->input('mark_dist_type'),
                'status' => 1,
                'description' => $request->input('description'),
            ]);

            return response()->json(['status' => 1, 'message' => __('Update message')]);
        }

        return response()->json(['status' => 1, 'examgroup' => $examGroup, 'examgrouplist' => $examGroups, 'marks_dist_types' => $marksDistTypes, 'examType' => $this->exam_type]);
    }

    // API to delete marks distribution component
    public function deleteMarksDistributionComponent($id)
    {
        ExamMarkDistributionComponent::where('id', $id)->update(['status' => 3]);
        return response()->json(['status' => 1, 'message' => __('Record deleted successfully')]);
    }

    // API to list subject-wise remarks
    public function subjectwiseRemarkList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|exists:subjects,id',
        ]);

        if ($request->isMethod('post') && $validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        if ($request->isMethod('post')) {
            $names = $request->input('name', []);
            foreach ($names as $name) {
                ExamSubjectwiseRemark::create([
                    'remark_name' => $name,
                    'subject_id' => $request->input('subject_id'),
                    'status' => 1,
                    'note' => $request->input('description'),
                ]);
            }
            return response()->json(['status' => 1, 'message' => __('Success message')]);
        }

        $examGroups = ExamSubjectwiseRemark::where('status', 1)->orderBy('id', 'asc')->get();
        $subjects = Subject::orderBy('id', 'asc')->get();
        return response()->json(['status' => 1, 'examgrouplist' => $examGroups, 'subjects' => $subjects, 'examType' => $this->exam_type]);
    }

    // API to edit subject-wise remark
    public function editSubjectwiseRemark(Request $request, $id)
    {
        $examGroup = ExamSubjectwiseRemark::findOrFail($id);
        $examGroups = ExamSubjectwiseRemark::where('status', 1)->orderBy('id', 'asc')->get();
        $subjects = Subject::orderBy('id', 'asc')->get();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
            }

            $examGroup->update([
                'remark_name' => $request->input('name'),
                'subject_id' => $request->input('subject_id'),
                'status' => 1,
                'note' => $request->input('description'),
            ]);

            return response()->json(['status' => 1, 'message' => __('Update message')]);
        }

        return response()->json(['status' => 1, 'examgroup' => $examGroup, 'examgrouplist' => $examGroups, 'subjects' => $subjects, 'examType' => $this->exam_type]);
    }

    // API to delete subject-wise remark
    public function deleteSubjectwiseRemark($id)
    {
        ExamSubjectwiseRemark::where('id', $id)->update(['status' => 3]);
        return response()->json(['status' => 1, 'message' => __('Record deleted successfully')]);
    }

    // API to list class-wise subject marks
    public function classwiseSubjectMarkList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|exists:classes,id',
        ]);

        if ($request->isMethod('post') && $validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        if ($request->isMethod('post')) {
            $subjectIds = $request->input('subject_id', []);
            if (empty($subjectIds)) {
                return response()->json(['status' => 0, 'message' => 'Invalid input. Please select subjects and enter marks.'], 422);
            }

            foreach ($subjectIds as $key => $subjectId) {
                ExamClasswiseSubjectsMark::create([
                    'class_id' => $request->input('class_id'),
                    'subject_id' => $subjectId,
                    'subject_mark_type' => $request->input("mark_type.$key", 0),
                    'max_mark' => $request->input("max_mark.$key", 0),
                    'min_mark' => $request->input("min_mark.$key", 0),
                    'aakarik_mark' => $request->input("aakarik_mark.$key", 0),
                    'sankalit_mark' => $request->input("sankalit_mark.$key", 0),
                    'description' => '',
                    'status' => 1,
                ]);
            }
            return response()->json(['status' => 1, 'message' => __('Success message')]);
        }

        $examGroups = ExamClasswiseSubjectsMark::where('status', 1)->orderBy('id', 'asc')->get();
        $subjects = Subject::orderBy('id', 'asc')->get();
        $classes = ClassModel::orderBy('id', 'asc')->get();
        $subjectGroups = SubjectGroup::all();

        return response()->json([
            'status' => 1,
            'examgrouplist' => $examGroups,
            'subjects' => $subjects,
            'classlist' => $classes,
            'subjectgroupList' => $subjectGroups,
            'examType' => $this->exam_type
        ]);
    }

    // API to edit class-wise subject mark
    public function editClasswiseSubjectMark(Request $request, $id)
    {
        $examGroup = ExamClasswiseSubjectsMark::findOrFail($id);
        $examGroups = ExamClasswiseSubjectsMark::where('status', 1)->orderBy('id', 'asc')->get();
        $subjects = Subject::orderBy('id', 'asc')->get();
        $classes = ClassModel::orderBy('id', 'asc')->get();
        $subjectGroups = SubjectGroup::all();

        $validator = Validator::make($request->all(), [
            'class_id' => 'required|exists:classes,id',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
            }

            $subjectIds = $request->input('subject_id', []);
            if (empty($subjectIds)) {
                return response()->json(['status' => 0, 'message' => 'Invalid input. Please select subject and enter marks.'], 422);
            }

            $examGroup->update([
                'class_id' => $request->input('class_id'),
                'subject_id' => $subjectIds[0], // Assuming single subject update
                'subject_mark_type' => $request->input("mark_type.0", 0),
                'max_mark' => $request->input("max_mark.0", 0),
                'min_mark' => $request->input("min_mark.0", 0),
                'aakarik_mark' => $request->input("aakarik_mark.0", 0),
                'sankalit_mark' => $request->input("sankalit_mark.0", 0),
                'description' => '',
                'status' => 1,
            ]);

            return response()->json(['status' => 1, 'message' => __('Update message')]);
        }

        return response()->json([
            'status' => 1,
            'examgroup' => $examGroup,
            'examgrouplist' => $examGroups,
            'subjects' => $subjects,
            'classlist' => $classes,
            'subjectgroupList' => $subjectGroups,
            'examType' => $this->exam_type
        ]);
    }

    // API to get subjects by class
    public function getSubjectByClass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|exists:classes,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        $classId = $request->input('class_id');
        $subjectGroups = SubjectGroup::all();
        $subjects = [];

        foreach ($subjectGroups as $group) {
            if ($group->sections) {
                foreach ($group->sections as $section) {
                    if ($section->class_id == $classId) {
                        foreach ($group->group_subject as $subject) {
                            $subjects[] = [
                                'id' => $subject->subject_id,
                                'name' => $subject->name . ' (' . $subject->type . ')',
                            ];
                        }
                        break;
                    }
                }
            }
        }

        return response()->json($subjects);
    }

    // API to delete class-wise subject mark
    public function deleteClasswiseSubjectMark($id)
    {
        ExamClasswiseSubjectsMark::where('id', $id)->update(['status' => 3]);
        return response()->json(['status' => 1, 'message' => __('Record deleted successfully')]);
    }

    // API to list class subject components
    public function classSubjectComponentList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|exists:classes,id',
        ]);

        if ($request->isMethod('post') && $validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        if ($request->isMethod('post')) {
            $markDistComps = $request->input('mark_dist_comp', []);
            if (empty($markDistComps)) {
                return response()->json(['status' => 0, 'message' => 'Invalid input. Please select subject and enter distribution marks.'], 422);
            }

            $existing = ExamClassSubjectsComponent::where('class_id', $request->input('class_id'))
                ->where('subject_id', $request->input('subject_id'))
                ->where('status', 1)
                ->first();

            if ($existing) {
                return response()->json(['status' => 0, 'message' => 'The marks distribution is already added for selected class & subject.'], 422);
            }

            $markDistCompData = [];
            foreach ($markDistComps as $compId) {
                $mdtid = $request->has("aakcompmark_$compId") ? 1 : ($request->has("sankcompmark_$compId") ? 3 : 0);
                $mark = $mdtid == 1 ? $request->input("aakcompmark_$compId") : ($mdtid == 3 ? $request->input("sankcompmark_$compId") : 0);
                $markDistCompData[] = [
                    'mdtid' => $mdtid,
                    'mdcid' => $compId,
                    'mark' => $mark,
                ];
            }

            ExamClassSubjectsComponent::create([
                'class_id' => $request->input('class_id'),
                'subject_id' => $request->input('subject_id'),
                'remark_language' => $request->input('subject_remark_lang', ''),
                'mdcid' => json_encode($markDistCompData),
                'status' => 1,
            ]);

            return response()->json(['status' => 1, 'message' => __('Success message')]);
        }

        $examGroups = ExamClasswiseSubjectsMark::where('status', 1)->orderBy('id', 'asc')->get();
        $subjects = Subject::orderBy('id', 'asc')->get();
        $classes = ClassModel::orderBy('id', 'asc')->get();
        $subjectGroups = SubjectGroup::all();
        $markDistComponents = ExamMarkDistributionComponent::where('status', 1)->orderBy('id', 'asc')->get();
        $markSubjectComponents = ExamClassSubjectsComponent::where('status', 1)->orderBy('id', 'asc')->get();

        return response()->json([
            'status' => 1,
            'examgrouplist' => $examGroups,
            'subjects' => $subjects,
            'classlist' => $classes,
            'subjectgroupList' => $subjectGroups,
            'mark_dist_components' => $markDistComponents,
            'mark_subject_components' => $markSubjectComponents,
            'examType' => $this->exam_type
        ]);
    }

    // API to get class subject marks
    public function getClassSubjectMarks(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        $examGroup = ExamClasswiseSubjectsMark::where('class_id', $request->input('class_id'))
            ->where('subject_id', $request->input('subject_id'))
            ->where('status', 1)
            ->first();

        if (!$examGroup) {
            return response()->json(['status' => 'fail', 'message' => 'Subject marks not found, please add Subject Marks.'], 404);
        }

        if ($examGroup->subject_mark_type == 2) {
            return response()->json(['status' => 'fail', 'message' => 'Can not add marks distributions for Grade subjects, please select other subject.'], 422);
        }

        $data = [
            'id' => $examGroup->id,
            'class_id' => $examGroup->class_id,
            'subject_id' => $examGroup->subject_id,
            'subject_mark_type' => $examGroup->subject_mark_type,
            'max_mark' => $examGroup->max_mark,
            'min_mark' => $examGroup->min_mark,
            'aakarik_mark' => $examGroup->aakarik_mark,
            'sankalit_mark' => $examGroup->sankalit_mark,
        ];

        return response()->json(['status' => 'success', 'message' => '', 'data' => $data]);
    }

    // API to edit class subject component
    public function editClassSubjectComponent(Request $request, $id)
    {
        $examGroup = ExamClassSubjectsComponent::findOrFail($id);
        $examGroups = ExamClasswiseSubjectsMark::where('status', 1)->orderBy('id', 'asc')->get();
        $subjects = Subject::orderBy('id', 'asc')->get();
        $classes = ClassModel::orderBy('id', 'asc')->get();
        $subjectGroups = SubjectGroup::all();
        $markDistComponents = ExamMarkDistributionComponent::where('status', 1)->orderBy('id', 'asc')->get();
        $markSubjectComponents = ExamClassSubjectsComponent::where('status', 1)->orderBy('id', 'asc')->get();

        $validator = Validator::make($request->all(), [
            'class_id' => 'required|exists:classes,id',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
            }

            $markDistComps = $request->input('mark_dist_comp', []);
            if (empty($markDistComps)) {
                return response()->json(['status' => 0, 'message' => 'Invalid input. Please select subject and enter distribution marks.'], 422);
            }

            $markDistCompData = [];
            foreach ($markDistComps as $compId) {
                $mdtid = $request->has("aakcompmark_$compId") ? 1 : ($request->has("sankcompmark_$compId") ? 3 : 0);
                $mark = $mdtid == 1 ? $request->input("aakcompmark_$compId") : ($mdtid == 3 ? $request->input("sankcompmark_$compId") : 0);
                $markDistCompData[] = [
                    'mdtid' => $mdtid,
                    'mdcid' => $compId,
                    'mark' => $mark,
                ];
            }

            $examGroup->update([
                'class_id' => $request->input('class_id'),
                'subject_id' => $request->input('subject_id'),
                'remark_language' => $request->input('subject_remark_lang', ''),
                'mdcid' => json_encode($markDistCompData),
                'status' => 1,
            ]);

            return response()->json(['status' => 1, 'message' => __('Update message')]);
        }

        return response()->json([
            'status' => 1,
            'examgroup' => $examGroup,
            'examgrouplist' => $examGroups,
            'subjects' => $subjects,
            'classlist' => $classes,
            'subjectgroupList' => $subjectGroups,
            'mark_dist_components' => $markDistComponents,
            'mark_subject_components' => $markSubjectComponents,
            'examType' => $this->exam_type
        ]);
    }

    // API to delete class subject component
    public function deleteClassSubjectComponent($id)
    {
        ExamClassSubjectsComponent::where('id', $id)->update(['status' => 3]);
        return response()->json(['status' => 1, 'message' => __('Record deleted successfully')]);
    }

    // API to list scorecard components
    public function scorecardComponentList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
        ]);

        if ($request->isMethod('post') && $validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        if ($request->isMethod('post')) {
            $names = $request->input('name', []);
            $grades = $request->input('grades', []);
            $classes = $request->input('class', []);

            foreach ($names as $name) {
                ExamScorecardComponent::create([
                    'component_name' => $name,
                    'subject_mark_grade' => !empty($grades) ? json_encode($grades) : '',
                    'classes' => !empty($classes) ? json_encode($classes) : '',
                    'status' => 1,
                ]);
            }
            return response()->json(['status' => 1, 'message' => __('Success message')]);
        }

        $examGroups = ExamScorecardComponent::where('status', 1)->orderBy('id', 'asc')->get();
        $grades = Grade::where('is_active', 'yes')->where('exam_type', 'school_grade_system')->orderBy('id', 'asc')->get();
        $classes = ClassModel::orderBy('id', 'asc')->get();

        return response()->json([
            'status' => 1,
            'examgrouplist' => $examGroups,
            'grades' => $grades,
            'classlist' => $classes,
            'examType' => $this->exam_type
        ]);
    }

    // API to edit scorecard component
    public function editScorecardComponent(Request $request, $id)
    {
        $examGroup = ExamScorecardComponent::findOrFail($id);
        $examGroups = ExamScorecardComponent::where('status', 1)->orderBy('id', 'asc')->get();
        $grades = Grade::where('is_active', 'yes')->where('exam_type', 'school_grade_system')->orderBy('id', 'asc')->get();
        $classes = ClassModel::orderBy('id', 'asc')->get();

        $validator = Validator::make($request->all(), [
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
        ]);

        if ($request->isMethod('post')) {
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
            }

            $names = $request->input('name', []);
            $grades = $request->input('grades', []);
            $classes = $request->input('class', []);

            $examGroup->update([
                'component_name' => $names[0], // Assuming single name update
                'subject_mark_grade' => !empty($grades) ? json_encode($grades) : '',
                'classes' => !empty($classes) ? json_encode($classes) : '',
                'status' => 1,
            ]);

            return response()->json(['status' => 1, 'message' => __('Update message')]);
        }

        return response()->json([
            'status' => 1,
            'examgroup' => $examGroup,
            'examgrouplist' => $examGroups,
            'grades' => $grades,
            'classlist' => $classes,
            'examType' => $this->exam_type
        ]);
    }

    // API to delete scorecard component
    public function deleteScorecardComponent($id)
    {
        ExamScorecardComponent::where('id', $id)->update(['status' => 3]);
        return response()->json(['status' => 1, 'message' => __('Record deleted successfully')]);
    }
}