<x-layouts.app :title="'Schedule Management'">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Schedules</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage departure schedules</p>
        </div>
        <a href="{{ route('admin.schedules.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl shadow-lg shadow-red-500/25 transition-all text-sm">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
            Add Schedule
        </a>
    </div>

    <div class="mb-6">
        <form method="GET" class="relative max-w-md">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ $search }}" placeholder="Search by train code or station..."
                class="w-full pl-12 pr-4 py-3 bg-white dark:bg-[#1e1e3a] border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-gray-700 dark:text-gray-200 placeholder-gray-400">
        </form>
    </div>

    <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50/80 dark:bg-white/5">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Train Code</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Origin</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">→</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Destination</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Departure</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($schedules as $schedule)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-lg text-xs font-mono font-bold">{{ $schedule->train_code }}</span>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-200">{{ $schedule->originStation->name ?? '—' }}</td>
                        <td class="px-6 py-4 text-center text-gray-400">→</td>
                        <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-200">{{ $schedule->destinationStation->name ?? '—' }}</td>
                        <td class="px-6 py-4 font-mono font-semibold text-gray-600 dark:text-gray-300">{{ $schedule->departure_time }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2.5 py-1 rounded-lg text-xs font-semibold {{ $schedule->is_active ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-gray-100 text-gray-500 dark:bg-white/10 dark:text-gray-400' }}">
                                {{ $schedule->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.schedules.edit', $schedule) }}" class="p-2 rounded-lg text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.schedules.destroy', $schedule) }}" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-6 py-12 text-center text-gray-400">No schedules found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layouts.app>
