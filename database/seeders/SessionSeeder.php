<?php

namespace Database\Seeders;

use App\Models\Session;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    public function run()
    {
        Session::create(['session' => '2024-2025']);
        Session::create(['session' => '2025-2026']);
    }
}
