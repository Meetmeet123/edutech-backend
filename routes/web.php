<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamPatternController;

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::group(['prefix' => 'api/exam-pattern'], function () {
    // File handling APIs
    Route::get('/export-format', [ExamPatternController::class, 'exportFormat'])->name('export.format');
    Route::post('/upload-file', [ExamPatternController::class, 'uploadFile'])->name('upload.file');

    // Exam group APIs
    Route::get('/exam-groups', [ExamPatternController::class, 'index'])->name('exam.groups.index');
    Route::post('/exam-groups', [ExamPatternController::class, 'store'])->name('exam.groups.store');
    Route::post('/exams-by-group', [ExamPatternController::class, 'getExamByExamgroup'])->name('exams.by.group');
    Route::delete('/exam-groups', [ExamPatternController::class, 'deleteExamGroup'])->name('exam.groups.delete');
    Route::delete('/exams', [ExamPatternController::class, 'deleteExam'])->name('exams.delete');
    Route::get('/exams/{id}', [ExamPatternController::class, 'getExamDetails'])->name('exams.details');
    Route::get('/exam-results/{id}', [ExamPatternController::class, 'getExamResult'])->name('exam.results.get');
    Route::post('/exam-results/{id}', [ExamPatternController::class, 'postExamResult'])->name('exam.results.post');

    // Marks distribution type APIs
    Route::get('/marks-distribution-types', [ExamPatternController::class, 'marksDistributionTypeList'])->name('marks.distribution.types.get');
    Route::post('/marks-distribution-types', [ExamPatternController::class, 'marksDistributionTypeList'])->name('marks.distribution.types.post');
    Route::get('/marks-distribution-types/{id}/edit', [ExamPatternController::class, 'editMarksDistributionType'])->name('marks.distribution.types.edit.get');
    Route::post('/marks-distribution-types/{id}/edit', [ExamPatternController::class, 'editMarksDistributionType'])->name('marks.distribution.types.edit.post');
    Route::delete('/marks-distribution-types/{id}', [ExamPatternController::class, 'deleteMarksDistributionType'])->name('marks.distribution.types.delete');

    // Marks distribution component APIs
    Route::get('/marks-distribution-components', [ExamPatternController::class, 'marksDistributionComponentList'])->name('marks.distribution.components.get');
    Route::post('/marks-distribution-components', [ExamPatternController::class, 'marksDistributionComponentList'])->name('marks.distribution.components.post');
    Route::get('/marks-distribution-components/{id}/edit', [ExamPatternController::class, 'editMarksDistributionComponent'])->name('marks.distribution.components.edit.get');
    Route::post('/marks-distribution-components/{id}/edit', [ExamPatternController::class, 'editMarksDistributionComponent'])->name('marks.distribution.components.edit.post');
    Route::delete('/marks-distribution-components/{id}', [ExamPatternController::class, 'deleteMarksDistributionComponent'])->name('marks.distribution.components.delete');

    // Subject-wise remark APIs
    Route::get('/subjectwise-remarks', [ExamPatternController::class, 'subjectwiseRemarkList'])->name('subjectwise.remarks.get');
    Route::post('/subjectwise-remarks', [ExamPatternController::class, 'subjectwiseRemarkList'])->name('subjectwise.remarks.post');
    Route::get('/subjectwise-remarks/{id}/edit', [ExamPatternController::class, 'editSubjectwiseRemark'])->name('subjectwise.remarks.edit.get');
    Route::post('/subjectwise-remarks/{id}/edit', [ExamPatternController::class, 'editSubjectwiseRemark'])->name('subjectwise.remarks.edit.post');
    Route::delete('/subjectwise-remarks/{id}', [ExamPatternController::class, 'deleteSubjectwiseRemark'])->name('subjectwise.remarks.delete');

    // Class-wise subject mark APIs
    Route::get('/classwise-subject-marks', [ExamPatternController::class, 'classwiseSubjectMarkList'])->name('classwise.subject.marks.get');
    Route::post('/classwise-subject-marks', [ExamPatternController::class, 'classwiseSubjectMarkList'])->name('classwise.subject.marks.post');
    Route::get('/classwise-subject-marks/{id}/edit', [ExamPatternController::class, 'editClasswiseSubjectMark'])->name('classwise.subject.marks.edit.get');
    Route::post('/classwise-subject-marks/{id}/edit', [ExamPatternController::class, 'editClasswiseSubjectMark'])->name('classwise.subject.marks.edit.post');
    Route::delete('/classwise-subject-marks/{id}', [ExamPatternController::class, 'deleteClasswiseSubjectMark'])->name('classwise.subject.marks.delete');
    Route::post('/subjects-by-class', [ExamPatternController::class, 'getSubjectByClass'])->name('subjects.by.class');

    // Class subject component APIs
    Route::get('/class-subject-components', [ExamPatternController::class, 'classSubjectComponentList'])->name('class.subject.components.get');
    Route::post('/class-subject-components', [ExamPatternController::class, 'classSubjectComponentList'])->name('class.subject.components.post');
    Route::get('/class-subject-components/{id}/edit', [ExamPatternController::class, 'editClassSubjectComponent'])->name('class.subject.components.edit.get');
    Route::post('/class-subject-components/{id}/edit', [ExamPatternController::class, 'editClassSubjectComponent'])->name('class.subject.components.edit.post');
    Route::delete('/class-subject-components/{id}', [ExamPatternController::class, 'deleteClassSubjectComponent'])->name('class.subject.components.delete');
    Route::post('/class-subject-marks', [ExamPatternController::class, 'getClassSubjectMarks'])->name('class.subject.marks');

    // Scorecard component APIs
    Route::get('/scorecard-components', [ExamPatternController::class, 'scorecardComponentList'])->name('scorecard.components.get');
    Route::post('/scorecard-components', [ExamPatternController::class, 'scorecardComponentList'])->name('scorecard.components.post');
    Route::get('/scorecard-components/{id}/edit', [ExamPatternController::class, 'editScorecardComponent'])->name('scorecard.components.edit.get');
    Route::post('/scorecard-components/{id}/edit', [ExamPatternController::class, 'editScorecardComponent'])->name('scorecard.components.edit.post');
    Route::delete('/scorecard-components/{id}', [ExamPatternController::class, 'deleteScorecardComponent'])->name('scorecard.components.delete');

});
