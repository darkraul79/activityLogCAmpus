<?php

use Darkraul79\Activitylogcampus\ActivityLogger;

if (!function_exists('activity')) {
    function activity(string $logName = null): ActivityLogger
    {
        $defaultLogName = config('activitylog.default_log_name');

        return app(ActivityLogger::class)->useLog($logName ?? $defaultLogName);
    }
}
