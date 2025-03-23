<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Enquiry;
use App\Models\FollowUp;
use App\Models\Source;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $source = $request->input('source');
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
        $status = $request->input('status', 'active');
        $perPage = $request->input('per_page', 10);

        $query = Enquiry::with(['class', 'followUps' => function ($query) {
            $query->latest()->select('id', 'enquiry_id', 'date', 'next_date', 'response', 'note', 'followup_by')->limit(1);
        }]);

        if ($source) $query->where('source', $source);
        if ($status !== 'all') $query->where('status', $status);
        if ($date_from && $date_to) {
            $query->whereBetween('date', [$date_from, $date_to]);
        } elseif ($status === 'active') {
            $query->where('status', 'active');
        }

        $enquiries = $query->orderBy('id', 'desc')->paginate($perPage);

        return response()->json($enquiries, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'reference' => 'nullable|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'follow_up_date' => 'nullable|date',
            'note' => 'nullable|string',
            'source' => 'required|exists:sources,name',
            'email' => 'nullable|email|max:255',
            'assigned' => 'nullable|string|max:255',
            'class' => 'nullable|exists:class_models,id',
            'no_of_child' => 'nullable|integer|min:0',
            'status' => 'nullable|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'errors' => $validator->errors()], 422);
        }

        try {
            $enquiry = Enquiry::create($request->all() + ['status' => 'active']);
            return response()->json(['status' => 'success', 'data' => $enquiry, 'message' => 'Enquiry created'], 201);
        } catch (\Exception $e) {
            Log::error('Error creating enquiry: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to create enquiry'], 500);
        }
    }

    public function show($id)
    {
        try {
            $enquiry = Enquiry::with('class')->findOrFail($id);
            return response()->json($enquiry, 200);
        } catch (\Exception $e) {
            Log::error('Error retrieving enquiry ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Enquiry not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'reference' => 'nullable|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'follow_up_date' => 'nullable|date',
            'note' => 'nullable|string',
            'source' => 'required|exists:sources,name',
            'email' => 'nullable|email|max:255',
            'assigned' => 'nullable|string|max:255',
            'class' => 'nullable|exists:class_models,id',
            'no_of_child' => 'nullable|integer|min:0',
            'status' => 'nullable|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'errors' => $validator->errors()], 422);
        }

        try {
            $enquiry = Enquiry::findOrFail($id);
            $enquiry->update($request->all());
            return response()->json(['status' => 'success', 'data' => $enquiry, 'message' => 'Enquiry updated'], 200);
        } catch (\Exception $e) {
            Log::error('Error updating enquiry ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to update enquiry'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $enquiry = Enquiry::findOrFail($id);
            $enquiry->delete();
            return response()->json(['status' => 'success', 'message' => 'Enquiry deleted'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting enquiry ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to delete enquiry'], 500);
        }
    }

    public function followUp(Request $request, $enquiryId)
    {
        $validator = Validator::make($request->all(), [
            'response' => 'required|string',
            'date' => 'required|date',
            'follow_up_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'errors' => $validator->errors()], 422);
        }

        try {
            $followUp = FollowUp::create([
                'enquiry_id' => $enquiryId,
                'date' => $request->date,
                'next_date' => $request->follow_up_date,
                'response' => $request->response,
                'note' => $request->note,
                'followup_by' => $request->input('followup_by', 'system'),
            ]);
            return response()->json(['status' => 'success', 'data' => $followUp, 'message' => 'Follow-up added'], 201);
        } catch (\Exception $e) {
            Log::error('Error adding follow-up for enquiry ID ' . $enquiryId . ': ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to add follow-up'], 500);
        }
    }

    public function getFollowUps($enquiryId)
    {
        try {
            $followUps = FollowUp::where('enquiry_id', $enquiryId)->orderBy('id', 'desc')->get();
            return response()->json($followUps, 200);
        } catch (\Exception $e) {
            Log::error('Error retrieving follow-ups for enquiry ID ' . $enquiryId . ': ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to retrieve follow-ups'], 500);
        }
    }

    public function deleteFollowUp($enquiryId, $followUpId)
    {
        try {
            $followUp = FollowUp::where('enquiry_id', $enquiryId)->findOrFail($followUpId);
            $followUp->delete();
            return response()->json(['status' => 'success', 'message' => 'Follow-up deleted'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting follow-up ID ' . $followUpId . ' for enquiry ID ' . $enquiryId . ': ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to delete follow-up'], 500);
        }
    }

    public function changeStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:active,inactive'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'errors' => $validator->errors()], 422);
        }

        try {
            $enquiry = Enquiry::findOrFail($id);
            $enquiry->update(['status' => $request->status]);
            return response()->json(['status' => 'success', 'message' => 'Status updated'], 200);
        } catch (\Exception $e) {
            Log::error('Error updating status for enquiry ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to update status'], 500);
        }
    }

    public function getClasses()
    {
        try {
            $classes = ClassModel::all();
            return response()->json($classes, 200);
        } catch (\Exception $e) {
            Log::error('Error retrieving classes: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to retrieve classes'], 500);
        }
    }

    public function getSources()
    {
        try {
            $sources = Source::all();
            return response()->json($sources, 200);
        } catch (\Exception $e) {
            Log::error('Error retrieving sources: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to retrieve sources'], 500);
        }
    }

    public function getReferences()
    {
        try {
            $references = Reference::all();
            return response()->json($references, 200);
        } catch (\Exception $e) {
            Log::error('Error retrieving references: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to retrieve references'], 500);
        }
    }
}