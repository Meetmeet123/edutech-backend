<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        define('endpoints', [
            "rolePermission",
            "transaction",
            "permission",
            "dashboard",
            "user",
            "role",
            "designation",
            "account",
            "setting",
            "email",
            "attendance",
            "department",
            "education",
            "payroll",
            "leaveApplication",
            "shift",
            "employmentStatus",
            "announcement",
            "salaryHistory",
            "designationHistory",
            "award",
            "awardHistory",
            "file",
            "leavePolicy",
            "weeklyHoliday",
            "publicHoliday",
            "project",
            "milestone",
            "task",
            "projectTeam",
            "taskDependency",
            "taskStatus",
            "taskTime",
            "priority",
            "assignedTask",
            "emailConfig",

        ]);

        define('PERMISSIONSTYPES', [
            'create',
            'readAll',
            "readSingle",
            'update',
            'delete',
        ]);
        foreach (endpoints as $endpoint) {
            foreach (PERMISSIONSTYPES as $permissionType) {
                $permission = new Permission();
                $permission->name = $permissionType . "-" . $endpoint;
                $permission->save();
            }
        }
    }
}
