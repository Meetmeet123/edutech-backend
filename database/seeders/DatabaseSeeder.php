<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\EmailConfig;
use App\Models\WeeklyHoliday;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            EmploymentSeeder::class,
            RoleSeeder::class,
            ShiftSeeder::class,
            WeeklyHolidaySeeder::class,
            LeavePolicySeeder::class,
            UsersSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            DesignationSeeder::class,
            AppSettingSeeder::class,
            AccountSeeder::class,
            SubAccountSeeder::class,
            EmailConfigSeeder::class,
            awardSeeder::class,
            PublicHolidaySeeder::class,
            TaskPrioritySeeder::class
        ]);
    }
}
