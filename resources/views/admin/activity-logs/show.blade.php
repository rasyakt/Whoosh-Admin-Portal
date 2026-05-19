<x-layouts.app :title="'Log Details: ' . $log->description">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('admin.activity-logs.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 flex items-center gap-1 mb-2 transition-colors">
                &larr; Back to Logs
            </a>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Activity Log Details</h1>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-gray-100 dark:border-white/10">
                    <h3 class="font-bold text-slate-900 dark:text-white tracking-tight">Overview</h3>
                </div>
                <div class="p-5">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</dt>
                            <dd class="mt-1 text-sm text-slate-900 dark:text-white font-semibold">{{ $log->description }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Log Name / Category</dt>
                            <dd class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider bg-gray-100 text-gray-700 dark:bg-white/10 dark:text-gray-400">
                                    {{ $log->log_name }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Timestamp</dt>
                            <dd class="mt-1 text-sm text-slate-900 dark:text-white font-medium">{{ $log->created_at->format('l, F j, Y g:i A') }} ({{ $log->created_at->diffForHumans() }})</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">IP Address</dt>
                            <dd class="mt-1 text-sm font-mono text-slate-700 dark:text-gray-300">{{ $log->ip_address ?? 'N/A' }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">User Agent</dt>
                            <dd class="mt-1 text-sm text-slate-900 dark:text-gray-200 break-words">{{ $log->user_agent ?? 'N/A' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-gray-100 dark:border-white/10">
                    <h3 class="font-bold text-slate-900 dark:text-white tracking-tight">Additional Properties</h3>
                </div>
                <div class="p-5">
                    @if($log->properties && count($log->properties) > 0)
                        <div class="bg-gray-50 dark:bg-[#111122] rounded-lg p-4 overflow-x-auto">
                            <pre class="text-sm font-mono text-slate-700 dark:text-gray-300"><code>{{ json_encode($log->properties, JSON_PRETTY_PRINT) }}</code></pre>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">No additional properties logged for this activity.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-gray-100 dark:border-white/10">
                    <h3 class="font-bold text-slate-900 dark:text-white tracking-tight">Actor Information</h3>
                </div>
                <div class="p-5">
                    @if($log->causer)
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600 dark:text-red-400 font-bold text-lg">
                                {{ substr($log->causer->name ?? 'U', 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $log->causer->name ?? 'Unknown User' }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $log->causer->email ?? 'No email' }}</p>
                            </div>
                        </div>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Type</dt>
                                <dd class="mt-0.5 text-sm font-medium text-slate-900 dark:text-white">{{ class_basename($log->causer_type) }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ID</dt>
                                <dd class="mt-0.5 text-sm font-medium text-slate-900 dark:text-white">#{{ $log->causer_id }}</dd>
                            </div>
                        </dl>
                    @else
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center text-gray-500 dark:text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900 dark:text-white">System / Guest</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">No authenticated user</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-gray-100 dark:border-white/10">
                    <h3 class="font-bold text-slate-900 dark:text-white tracking-tight">Target (Subject)</h3>
                </div>
                <div class="p-5">
                    @if($log->subject)
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Type</dt>
                                <dd class="mt-0.5 text-sm font-medium text-slate-900 dark:text-white">{{ class_basename($log->subject_type) }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">ID</dt>
                                <dd class="mt-0.5 text-sm font-medium text-slate-900 dark:text-white">#{{ $log->subject_id }}</dd>
                            </div>
                        </dl>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">No specific target model for this log.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
