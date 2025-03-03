<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\EmailConfig;

class EmailConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emailConfig = new EmailConfig();
        $emailConfig->emailConfigName = 'Omega';
        $emailConfig->emailHost = 'mail.osapp.net';
        $emailConfig->emailPort = '465';
        $emailConfig->emailUser = 'test@osapp.net';
        $emailConfig->emailPass = 'omega2020';
        $emailConfig->save();
    }
}
