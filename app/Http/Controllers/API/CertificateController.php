<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CertificateController extends Controller
{
    public function index()
    {
        $certificate = new Certificate();
        $certificateList = $certificate->certificateList();
        return response()->json(['status' => 'success', 'certificates' => $certificateList]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'certificate_name' => 'required|string|max:255',
            'certificate_text' => 'required|string',
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'header_height' => 'nullable|integer|min:0',
            'content_height' => 'nullable|integer|min:0',
            'footer_height' => 'nullable|integer|min:0',
            'content_width' => 'nullable|integer|min:0',
            'image_height' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
        }

        $backgroundImage = '';
        if ($request->hasFile('background_image')) {
            $backgroundImage = $request->file('background_image')->store('certificates', 'public');
        }

        $enableStudentImage = $request->input('is_active_student_img') == 1 ? 1 : 0;
        $imageHeight = $enableStudentImage ? $request->input('image_height', 0) : 0;

        $data = [
            'certificate_name' => $request->input('certificate_name'),
            'certificate_text' => $request->input('certificate_text'),
            'left_header' => $request->input('left_header'),
            'center_header' => $request->input('center_header'),
            'right_header' => $request->input('right_header'),
            'left_footer' => $request->input('left_footer'),
            'right_footer' => $request->input('right_footer'),
            'center_footer' => $request->input('center_footer'),
            'created_for' => 2,
            'status' => 1,
            'background_image' => $backgroundImage,
            'header_height' => $request->input('header_height', 0),
            'content_height' => $request->input('content_height', 0),
            'footer_height' => $request->input('footer_height', 0),
            'content_width' => $request->input('content_width', 0),
            'enable_student_image' => $enableStudentImage,
            'enable_image_height' => $imageHeight,
        ];

        $certificate = new Certificate();
        $result = $certificate->addCertificate($data);

        if ($result) {
            return response()->json(['status' => 'success', 'message' => 'Certificate created', 'data' => ['id' => $result]], 200);
        }

        return response()->json(['status' => 'error', 'message' => 'Failed to create certificate'], 500);
    }

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'certificate_name' => 'required|string|max:255',
            'certificate_text' => 'required|string',
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'header_height' => 'nullable|integer|min:0',
            'content_height' => 'nullable|integer|min:0',
            'footer_height' => 'nullable|integer|min:0',
            'content_width' => 'nullable|integer|min:0',
            'image_height' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()], 422);
        }

        $enableStudentImage = $request->input('is_active_student_img') == 1 ? 1 : 0;
        $imageHeight = $enableStudentImage ? $request->input('image_height', 0) : 0;

        $data = [
            'id' => $id,
            'certificate_name' => $request->input('certificate_name'),
            'certificate_text' => $request->input('certificate_text'),
            'left_header' => $request->input('left_header'),
            'center_header' => $request->input('center_header'),
            'right_header' => $request->input('right_header'),
            'left_footer' => $request->input('left_footer'),
            'right_footer' => $request->input('right_footer'),
            'center_footer' => $request->input('center_footer'),
            'header_height' => $request->input('header_height', 0),
            'content_height' => $request->input('content_height', 0),
            'footer_height' => $request->input('footer_height', 0),
            'content_width' => $request->input('content_width', 0),
            'enable_student_image' => $enableStudentImage,
            'enable_image_height' => $imageHeight,
        ];

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('certificates', 'public');
        }

        $certificate = new Certificate();
        $result = $certificate->addCertificate($data);

        if ($result) {
            return response()->json(['status' => 'success', 'message' => 'Certificate updated', 'data' => ['id' => $result]], 200);
        }

        return response()->json(['status' => 'error', 'message' => 'Failed to update certificate'], 500);
    }

    public function delete($id)
    {
        $certificate = new Certificate();
        $result = $certificate->remove($id);

        if ($result) {
            return response()->json(['status' => 'success', 'message' => 'Certificate deleted'], 200);
        }

        return response()->json(['status' => 'error', 'message' => 'Failed to delete certificate'], 500);
    }

    public function viewCertificate($id)
    {
        $certificateModel = new Certificate(); // Create an instance
        $certificate = $certificateModel->certificateById($id); // Call on the instance

        if (!$certificate) {
            return response()->json(['status' => 'error', 'message' => 'Certificate not found'], 404);
        }

        return response()->json(['status' => 'success', 'certificate' => $certificate]);
    }

    public function previewCertificate($id)
    {
        $certificateModel = new Certificate(); // Create an instance
        $certificate = $certificateModel->certificateById($id); // Call on the instance

        if (!$certificate) {
            return response()->json(['status' => 'error', 'message' => 'Certificate not found'], 404);
        }

        return response()->json(['status' => 'success', 'view' => view('certificate.preview', compact('certificate'))->render()]);
    }
}