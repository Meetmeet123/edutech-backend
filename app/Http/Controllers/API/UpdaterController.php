<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Updater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UpdaterController extends Controller
{
    public function index($chk = null)
    {
        // Simulate RBAC check (replace with actual authorization logic)
        // if (!$this->rbac()->hasPrivilege('superadmin', 'can_view')) {
        //     return response()->json(['message' => 'Access denied'], 403);
        // }

        $data = [];
        $updater = Updater::first();

        if ($chk === null || $chk === "") {
            $response = $this->checkup();
            $resJson = json_decode($response, true);
            $data['version'] = $resJson['version'] ?? null;
        } else {
            if (!$updater || !$updater->message && !$updater->error) {
                $response = $this->checkup();
                $resJson = json_decode($response, true);
                $data['version'] = $resJson['version'] ?? null;
            } else {
                $response = $this->checkup();
                $resJson = json_decode($response, true);
                $data['version'] = $resJson['version'] ?? $updater->version ?? null;
            }
        }

        return response()->json(['data' => $data]);
    }

    public function checkup()
    {
        try {
            $response = Http::get('https://example.com/update-check'); // Replace with actual URL
            $updater = Updater::firstOrCreate(['id' => 1]); // Ensure a single record

            if ($response->successful()) {
                $result = $response->json();
                $newVersion = $result['version'] ?? '1.0.0'; // Default version

                $updater->update([
                    'version' => $newVersion,
                    'last_checked' => now(),
                    'message' => 'Update check successful',
                    'error' => null
                ]);

                return json_encode(['version' => $newVersion]);
            } else {
                $updater->update([
                    'last_checked' => now(),
                    'message' => null,
                    'error' => 'Update check failed'
                ]);

                return json_encode(['version' => $updater->version ?? null]);
            }
        } catch (\Exception $e) {
            return json_encode(['version' => null, 'error' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $updater = Updater::firstOrCreate(['id' => 1]);
            $updater->update(['message' => null, 'error' => null]);

            $response = $this->autoUpdate();
            $updater->update([
                'message' => $response['message'] ?? 'Update initiated',
                'error' => $response['error'] ?? null
            ]);

            $redirectToken = \Illuminate\Support\Str::random(16);
            return response()->json(['message' => 'Update initiated', 'redirect' => '/api/updater/' . $redirectToken]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    protected function autoUpdate()
    {
        try {
            $response = Http::post('https://example.com/auto-update'); // Replace with actual URL
            if ($response->successful()) {
                $result = $response->json();
                $newVersion = $result['version'] ?? '1.0.0'; // Update version if provided
                $updater = Updater::firstOrCreate(['id' => 1]);
                $updater->update(['version' => $newVersion]);
                return ['message' => 'Update successful', 'error' => ''];
            } else {
                return ['message' => '', 'error' => 'Update failed'];
            }
        } catch (\Exception $e) {
            return ['message' => '', 'error' => $e->getMessage()];
        }
    }

    protected function rbac()
    {
        return new class {
            public function hasPrivilege($role, $privilege) {
                return $role === 'superadmin' && $privilege === 'can_view';
            }
        };
    }
}