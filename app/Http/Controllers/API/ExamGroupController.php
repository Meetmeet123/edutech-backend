<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ExamGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamGroupController extends Controller
{
    public function index()
    {
        $examGroups = ExamGroup::all();
        return response()->json($examGroups);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'exam_type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['name', 'exam_type', 'description']);
        $data['is_active'] = $request->input('is_active', 0);

        $examGroup = ExamGroup::create($data);

        return response()->json(['message' => 'Exam group created successfully', 'data' => $examGroup], 201);
    }

    public function show($id)
    {
        $examGroup = ExamGroup::findOrFail($id);
        return response()->json($examGroup);
    }

    public function update(Request $request, $id)
    {
        $examGroup = ExamGroup::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'exam_type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['name', 'exam_type', 'description']);
        $data['is_active'] = $request->input('is_active', 0);

        $examGroup->update($data);

        return response()->json(['message' => 'Exam group updated successfully', 'data' => $examGroup]);
    }

    public function destroy($id)
    {
        $examGroup = ExamGroup::findOrFail($id);
        $examGroup->delete();

        return response()->json(['message' => 'Exam group deleted successfully']);
    }

    // Add other methods as needed, converting CodeIgniter logic to Laravel
}