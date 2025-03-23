<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\VisitorsPurpose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VisitorsController extends Controller
{
    public function index()
    {
        $visitors = Visitor::orderBy('id', 'desc')->get();
        return response()->json($visitors);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'purpose' => 'required|string',
            'name' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|string', // Expect base64 string
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $visitorData = $request->only([
                'purpose', 'name', 'contact', 'id_proof', 'no_of_pepple', 'date',
                'in_time', 'out_time', 'note'
            ]);
            $visitor = Visitor::create($visitorData);

            if ($request->has('image') && $request->image) {
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->image));
                $imgName = 'id' . $visitor->id . '.jpg'; // Default to jpg, adjust as needed
                Storage::disk('public')->put('visitors/' . $imgName, $imageData);
                $visitor->update(['image' => $imgName]);
            }

            DB::commit();
            return response()->json(['status' => 'success', 'data' => $visitor, 'message' => 'Visitor added'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $visitor = Visitor::findOrFail($id);
        return response()->json($visitor);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'purpose' => 'required|string',
            'name' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|string', // Expect base64 string
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $visitor = Visitor::findOrFail($id);
            $visitorData = $request->only([
                'purpose', 'name', 'contact', 'id_proof', 'no_of_pepple', 'date',
                'in_time', 'out_time', 'note'
            ]);
            $visitor->update($visitorData);

            if ($request->has('image') && $request->image) {
                if ($visitor->image) {
                    Storage::disk('public')->delete('visitors/' . $visitor->image);
                }
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->image));
                $imgName = 'id' . $id . '.jpg'; // Default to jpg, adjust as needed
                Storage::disk('public')->put('visitors/' . $imgName, $imageData);
                $visitor->update(['image' => $imgName]);
            }

            DB::commit();
            return response()->json(['status' => 'success', 'data' => $visitor, 'message' => 'Visitor updated']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $visitor = Visitor::findOrFail($id);
            if ($visitor->image) {
                Storage::disk('public')->delete('visitors/' . $visitor->image);
            }
            $visitor->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Visitor deleted']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function getPurposes()
    {
        $purposes = VisitorsPurpose::all();
        return response()->json($purposes);
    }
}