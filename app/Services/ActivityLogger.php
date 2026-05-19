<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\AdminUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    public static function log(string $description, ?Model $subject = null, ?array $properties = null, ?string $logName = 'default')
    {
        $causer = null;
        if (session()->has('admin_user')) {
            $sessionUser = session('admin_user');
            $causer = AdminUser::find($sessionUser['id']);
        } else if (auth()->check()) {
            $causer = auth()->user();
        }

        return ActivityLog::create([
            'log_name' => $logName,
            'description' => $description,
            'subject_type' => $subject ? get_class($subject) : null,
            'subject_id' => $subject ? $subject->id : null,
            'causer_type' => $causer ? get_class($causer) : null,
            'causer_id' => $causer ? $causer->id : null,
            'properties' => $properties,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
