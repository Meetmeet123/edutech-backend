<?php

namespace App\Http\Controllers;

use App\Models\EmailConfig;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

//
class EmailConfigController extends Controller
{
    //getSingle email config
    public function getSingleEmailConfig(): JsonResponse
    {
        try {
            $emailConfig = EmailConfig::find(1);
            unset($emailConfig->emailPass);

            $converted = arrayKeysToCamelCase($emailConfig->toArray());
            return response()->json($converted);
        } catch (Exception $err) {
            return response()->json(['error' => 'An error occurred during getting single email config. Please try again later.'], 500);
        }
    }

    //update email config
    public function updateEmailConfig(Request $request): JsonResponse
    {
        try {
            $emailConfig = EmailConfig::findOrFail(1);
            $emailConfig->update([
                'emailConfigName' => $request->input("emailConfigName"),
                'emailHost' => $request->input("emailHost"),
                'emailPort' => $request->input("emailPort"),
                'emailUser' => $request->input("emailUser"),
                'emailPass' => $request->input("emailPass"),
            ]);

            if (!$emailConfig) {
                return response()->json(['error' => 'Failed to Update EmailConfig'], 404);
            }
            return response()->json(['message' => 'Email Config Updated Successfully'], 200);
        } catch (Exception $err) {
            return response()->json(['error' => 'An error occurred during updating email config. Please try again later.'], 500);
        }
    }
}
