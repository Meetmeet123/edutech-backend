<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('user', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('user')
                ->prefix('user')
                ->group(base_path('routes/userRoutes.php'));
            Route::middleware('permission')
                ->prefix('permission')
                ->group(base_path('routes/permissionRoutes.php'));
            Route::middleware('role')
                ->prefix('role')
                ->group(base_path('routes/roleRoutes.php'));
            Route::middleware('setting')
                ->prefix('setting')
                ->group(base_path('routes/appSettingRoutes.php'));
            Route::middleware('announcement')
                ->prefix('announcement')
                ->group(base_path('routes/announcementRoutes.php'));
            Route::middleware('account')
                ->prefix('account')
                ->group(base_path('routes/accountRoutes.php'));
            Route::middleware('transaction')
                ->prefix('transaction')
                ->group(base_path('routes/transactionRoutes.php'));
            Route::middleware('award')
                ->prefix('award')
                ->group(base_path('routes/awardRoutes.php'));
            Route::middleware('awardHistory')
                ->prefix('awardHistory')
                ->group(base_path('routes/awardHistoryRoutes.php'));
            Route::middleware('shift')
                ->prefix('shift')
                ->group(base_path('routes/shiftRoutes.php'));
            Route::middleware('education')
                ->prefix('education')
                ->group(base_path('routes/educationRoutes.php'));
            Route::middleware('role-permission')
                ->prefix('role-permission')
                ->group(base_path('routes/rolePermissionRoutes.php'));
            Route::middleware('department')
                ->prefix('department')
                ->group(base_path('routes/departmentRoutes.php'));
            Route::middleware('designation')
                ->prefix('designation')
                ->group(base_path('routes/designationRoutes.php'));
            Route::middleware('designationHistory')
                ->prefix('designationHistory')
                ->group(base_path('routes/designationHistoryRoutes.php'));
            Route::middleware('employment-status')
                ->prefix('employment-status')
                ->group(base_path('routes/employmentStatusRoutes.php'));
            Route::middleware('salaryHistory')
                ->prefix('salaryHistory')
                ->group(base_path('routes/salaryHistoryRoutes.php'));
            Route::middleware('files')
                ->prefix('files')
                ->group(base_path('routes/filesRoutes.php'));
            Route::middleware('email-config')
                ->prefix('email-config')
                ->group(base_path('routes/emailConfigRoutes.php'));
            Route::middleware('email')
                ->prefix('email')
                ->group(base_path('routes/emailRoutes.php'));
            Route::middleware('dashboard')
                ->prefix('dashboard')
                ->group(base_path('routes/dashboardRoutes.php'));
            Route::middleware('public-holiday')
                ->prefix('public-holiday')
                ->group(base_path('routes/publicHolidayRoutes.php'));
            Route::middleware('weekly-holiday')
                ->prefix('weekly-holiday')
                ->group(base_path('routes/weeklyHolidayRoutes.php'));
            Route::middleware('task-priority')
                ->prefix('task-priority')
                ->group(base_path('routes/priorityRoutes.php'));
            Route::middleware('project')
                ->prefix('project')
                ->group(base_path('routes/projectRoutes.php'));

            Route::middleware('leave-policy')
                ->prefix('leave-policy')
                ->group(base_path('routes/leavePolicyRoutes.php'));
            Route::middleware('leave-application')
                ->prefix('leave-application')
                ->group(base_path('routes/leaveApplicationRoutes.php'));
            Route::middleware('attendance')
                ->prefix('attendance')
                ->group(base_path('routes/attendanceRoutes.php'));
            Route::middleware('payroll')
                ->prefix('payroll')
                ->group(base_path('routes/payrollRoutes.php'));
            Route::middleware('milestone')
                ->prefix('milestone')
                ->group(base_path('routes/milestoneRoutes.php'));
            Route::middleware('tasks')
                ->prefix('tasks')
                ->group(base_path('routes/taskRoutes.php'));
            Route::middleware('task-status')
                ->prefix('task-status')
                ->group(base_path('routes/taskStatusRoutes.php'));
            Route::middleware('project-team')
                ->prefix('project-team')
                ->group(base_path('routes/projectTeamRoutes.php'));
        });
    }
}
