<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/*',
        'api/settings/mysql-version',
        'api/settings/sql-mode',
        'api/settings/*',
        'api/sessions/*',
        'api/notification-settings/*',
        'api/sms-config/*',
        'api/email-config/*',
        'api/payment-settings/*',
        'api/front-cms-settings/*',
        'api/roles/*',
        'api/languages/*',
        'api/currencies/*',
        'api/users/*',
        'api/modules/*',
        'api/module-permissions/*',
        'api/custom-fields/*',
        'api/captcha/*',
        'api/system-fields/*',
        'api/filetypes/*',
        'api/sidebar-menus/*',
        'api/sidebar-sub-menus/*',
        'api/updater/*',
        'api/whatsapp-configs/*',
        'api/certificates/*',
        'api/backup/*',
        'api/downloadbackup/*',
        'api/dropbackup/*',
        'api/enquiry/*',
        'api/visitors/*',
        'api/general-calls/*',
        'api/dispatch/*',
        'api/complaints/*',
        'api/visitors-purposes/*',
        'api/complaint-types/*',
        'api/sources/*',
        'api/references/*',
        'api/exam-groups/*',
    ];
}