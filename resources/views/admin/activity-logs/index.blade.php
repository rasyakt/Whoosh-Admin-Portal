<x-layouts.app :title="'Activity Logs'">

    <div class="mb-6 flex flex-col sm:flex-row gap-4 items-center justify-between">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Activity Logs</h1>
        <form method="GET" action="{{ route('admin.activity-logs.index') }}" class="flex gap-2 w-full sm:w-auto">
            <select name="log_name" class="border border-gray-300 dark:border-white/10 bg-white dark:bg-[#1a1a2e] text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block p-2.5 dark:text-white">
                <option value="">All Logs</option>
                @foreach($logNames as $name)
                    <option value="{{ $name }}" {{ request('log_name') === $name ? 'selected' : '' }}>{{ ucfirst($name) }}</option>
                @endforeach
            </select>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search description, IP..." class="border border-gray-300 dark:border-white/10 bg-white dark:bg-[#1a1a2e] text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block p-2.5 dark:text-white w-full sm:w-64" />
            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                Filter
            </button>
        </form>
    </div>

    <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left min-w-[1000px]">
                <thead class="bg-gray-50 dark:bg-white/5 text-slate-600 dark:text-gray-400 text-xs uppercase font-bold tracking-wider border-b border-gray-200 dark:border-white/10">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">Timestamp</th>
                        <th class="px-6 py-4 whitespace-nowrap">Actor</th>
                        <th class="px-6 py-4 whitespace-nowrap">Log Name</th>
                        <th class="px-6 py-4 whitespace-nowrap">Description</th>
                        <th class="px-6 py-4 whitespace-nowrap">IP Address</th>
                        <th class="px-6 py-4 whitespace-nowrap text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($logs as $log)
                    <tr class="hover:bg-gray-50/80 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400 text-xs font-medium">{{ $log->created_at->format('M d, Y H:i:s') }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200 whitespace-nowrap">
                            @if($log->causer)
                                {{ $log->causer->name ?? 'User #'.$log->causer_id }}
                                <span class="text-xs text-gray-400 ml-1">({{ class_basename($log->causer_type) }})</span>
                            @else
                                <span class="text-gray-400 italic">System / Guest</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider bg-gray-100 text-gray-700 dark:bg-white/10 dark:text-gray-400">
                                {{ $log->log_name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-900 dark:text-gray-200">{{ $log->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-slate-600 dark:text-gray-400">{{ $log->ip_address ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.activity-logs.show', $log->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">View Details</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400">No activity logs found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($logs->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 dark:border-white/10">
            {{ $logs->links() }}
        </div>
        @endif
    </div>

</x-layouts.app>
