<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DispatchReceive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DispatchController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'dispatch'); // Default to 'dispatch'
        $dispatches = DispatchReceive::where('type', $type)
            ->orderBy('id', 'desc')
            ->get();
        return response()->json($dispatches);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to_title' => 'required|string',
            'from_title' => 'required|string',
            'date' => 'required|date',
            'type' => 'required|in:dispatch,receive',
            'image' => 'nullable|string', // Expect base64 string
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $dispatchData = $request->only([
                'reference_no', 'to_title', 'address', 'note', 'from_title', 'date', 'type'
            ]);
            $dispatch = DispatchReceive::create($dispatchData);

            if ($request->has('image') && $request->image) {
                $imageData = base64_decode(preg_replace('#^data:(image|application)/(jpeg|png|pdf);base64,#i', '', $request->image));
                $extension = strpos($request->image, 'pdf') !== false ? 'pdf' : 'jpg'; // Default to jpg for images
                $imgName = 'id' . $dispatch->id . '.' . $extension;
                Storage::disk('public')->put('dispatch_receive/' . $imgName, $imageData);
                $dispatch->update(['image' => $imgName]);
            }

            DB::commit();
            return response()->json(['status' => 'success', 'data' => $dispatch, 'message' => 'Record added'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $dispatch = DispatchReceive::findOrFail($id);
        return response()->json($dispatch);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'to_title' => 'required|string',
            'from_title' => 'required|string',
            'date' => 'required|date',
            'type' => 'required|in:dispatch,receive',
            'image' => 'nullable|string', // Expect base64 string
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $dispatch = DispatchReceive::findOrFail($id);
            $dispatchData = $request->only([
                'reference_no', 'to_title', 'address', 'note', 'from_title', 'date', 'type'
            ]);
            $dispatch->update($dispatchData);

            if ($request->has('image') && $request->image) {
                if ($dispatch->image) {
                    Storage::disk('public')->delete('dispatch_receive/' . $dispatch->image);
                }
                $imageData = base64_decode(preg_replace('#^data:(image|application)/(jpeg|png|pdf);base64,#i', '', $request->image));
                $extension = strpos($request->image, 'pdf') !== false ? 'pdf' : 'jpg'; // Default to jpg for images
                $imgName = 'id' . $id . '.' . $extension;
                Storage::disk('public')->put('dispatch_receive/' . $imgName, $imageData);
                $dispatch->update(['image' => $imgName]);
            }

            DB::commit();
            return response()->json(['status' => 'success', 'data' => $dispatch, 'message' => 'Record updated']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $dispatch = DispatchReceive::findOrFail($id);
            if ($dispatch->image) {
                Storage::disk('public')->delete('dispatch_receive/' . $dispatch->image);
            }
            $dispatch->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Record deleted']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function download($id)
    {
        $dispatch = DispatchReceive::findOrFail($id);
        if ($dispatch->image) {
            $filePath = storage_path('app/public/dispatch_receive/' . $dispatch->image);
            if (file_exists($filePath)) {
                return response()->download($filePath, $dispatch->image);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'File not found'], 404);
    }
}