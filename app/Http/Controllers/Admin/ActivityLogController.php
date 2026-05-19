<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with(['causer', 'subject'])->latest();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('description', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%")
                  ->orWhere('log_name', 'like', "%{$search}%");
        }

        if ($request->has('log_name') && $request->input('log_name') !== '') {
            $query->where('log_name', $request->input('log_name'));
        }

        $logs = $query->paginate(15);
        $logNames = ActivityLog::select('log_name')->distinct()->pluck('log_name');

        return view('admin.activity-logs.index', compact('logs', 'logNames'));
    }

    public function show($id)
    {
        $log = ActivityLog::with(['causer', 'subject'])->findOrFail($id);
        
        return view('admin.activity-logs.show', compact('log'));
    }
}
