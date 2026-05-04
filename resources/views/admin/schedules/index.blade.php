<x-layouts.app :title="'Schedule Management'">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Schedules</h1>
            <p class="text-sm text-gray-500 mt-1">Manage departure schedules</p>
        </div>
        <a href="{{ route('admin.schedules.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-sm transition-colors text-sm">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Schedule
        </a>
    </div>

    <div class="mb-6">
        <form method="GET" class="relative max-w-md">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ $search }}" placeholder="Search by train code or station..."
                class="w-full pl-12 pr-4 py-3 bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white placeholder-gray-400 shadow-sm">
        </form>
    </div>

    <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left min-w-[900px]">
                <thead class="bg-gray-50 dark:bg-white/5 text-slate-600 dark:text-gray-400 text-xs uppercase font-bold tracking-wider border-b border-gray-200 dark:border-white/10">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">Train Code</th>
                        <th class="px-6 py-4 whitespace-nowrap">Origin</th>
                        <th class="px-6 py-4 text-center whitespace-nowrap">→</th>
                        <th class="px-6 py-4 whitespace-nowrap">Destination</th>
                        <th class="px-6 py-4 whitespace-nowrap">Departure</th>
                        <th class="px-6 py-4 text-center whitespace-nowrap">Status</th>
                        <th class="px-6 py-4 text-right whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($schedules as $schedule)
                    <tr class="hover:bg-gray-50/80 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-1 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-md text-xs font-mono font-bold">{{ $schedule->train_code }}</span>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200 whitespace-nowrap">{{ $schedule->originStation->name ?? '—' }}</td>
                        <td class="px-6 py-4 text-center text-gray-400 whitespace-nowrap">→</td>
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200 whitespace-nowrap">{{ $schedule->destinationStation->name ?? '—' }}</td>
                        <td class="px-6 py-4 font-mono font-bold text-slate-700 dark:text-gray-300 whitespace-nowrap">{{ $schedule->departure_time }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <span class="px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider {{ $schedule->is_active ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-gray-100 text-gray-500 dark:bg-white/10 dark:text-gray-400' }}">
                                {{ $schedule->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-end">
                                <x-table-actions-dropdown 
                                    :editRoute="route('admin.schedules.edit', $schedule)"
                                    :deleteRoute="route('admin.schedules.destroy', $schedule)"
                                    deleteConfirm="Are you sure you want to delete this schedule?"
                                />
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
