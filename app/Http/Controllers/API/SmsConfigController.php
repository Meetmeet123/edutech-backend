<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SmsConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmsConfigController extends Controller
{
    public function get($id = null)
    {
        if ($id) {
            $smsConfig = SmsConfig::find($id);
            return response()->json(['data' => $smsConfig ? $smsConfig->toArray() : null], 200);
        } else {
            $smsConfigs = SmsConfig::orderBy('id')->get()->toArray();
            return response()->json(['data' => $smsConfigs], 200);
        }
    }

    public function changeStatus($type)
    {
        try {
            DB::beginTransaction();
            SmsConfig::where('type', '!=', $type)->update(['status' => false]); // Disable others
            SmsConfig::where('type', $type)->update(['status' => true]); // Enable the specified type
            DB::commit();
            return response()->json(['message' => 'Status updated: ' . $type . ' enabled, others disabled'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validate([
                'type' => 'required|string|unique:sms_config,type',
                'status' => 'required|boolean',
            ]);

            $smsConfig = SmsConfig::create($data);
            if ($data['status']) {
                $this->changeStatus($data['type']);
            }

            DB::commit();
            return response()->json([
                'message' => "Inserted SMS config with id " . $smsConfig->id,
                'data' => $smsConfig
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function getActiveSMS()
    {
        $smsConfig = DB::select("
        SELECT id, type, status, created_at, updated_at
        FROM sms_config
        WHERE status = 1
        LIMIT 1
    ");

        
        if (empty($smsConfig)) {
            $smsConfig = DB::select("
            SELECT id, type, status, created_at, updated_at
            FROM sms_config
            ORDER BY id ASC
            LIMIT 1
        ");
        }

        $result = !empty($smsConfig) ? $smsConfig[0] : null;
        if ($result) {
            $result->status = (bool) $result->status;
        }

        return response()->json(['data' => $result], 200);
    }
}