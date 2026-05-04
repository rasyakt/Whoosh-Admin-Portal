<x-layouts.app :title="'Station Management'">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Stations</h1>
            <p class="text-sm text-gray-500 mt-1">Manage all train stations in the Whoosh network</p>
        </div>
        <a href="{{ route('admin.stations.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-sm transition-colors text-sm">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
            Add Station
        </a>
    </div>

    {{-- Search --}}
    <div class="mb-6">
        <form method="GET" class="relative max-w-md">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ $search }}" placeholder="Search stations..."
                class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-[#1e1e3a] border border-gray-200 dark:border-white/10 rounded-lg text-slate-900 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-red-600 focus:border-red-600 transition-colors text-sm shadow-sm">
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left min-w-[900px]">
                <thead class="bg-gray-50 dark:bg-white/5 text-slate-600 dark:text-gray-400 text-xs uppercase font-bold tracking-wider border-b border-gray-200 dark:border-white/10">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">ID</th>
                        <th class="px-6 py-4 whitespace-nowrap">Station Name</th>
                        <th class="px-6 py-4 whitespace-nowrap">Code</th>
                        <th class="px-6 py-4 whitespace-nowrap">Location</th>
                        <th class="px-6 py-4 whitespace-nowrap">Facilities</th>
                        <th class="px-6 py-4 text-right whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($stations as $station)
                    <tr class="hover:bg-gray-50/80 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 text-gray-400 font-mono text-xs whitespace-nowrap">{{ $station->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 flex items-center justify-center text-xs font-bold">
                                    {{ strtoupper(substr($station->code ?? $station->name, 0, 2)) }}
                                </div>
                                <span class="font-semibold text-slate-900 dark:text-gray-200">{{ $station->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-1 bg-gray-100 dark:bg-white/10 rounded-md text-xs font-mono font-medium text-slate-700 dark:text-gray-300">
                                {{ $station->code }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $station->location ?? '—' }}</td>
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $station->facilities ?? '—' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-end">
                                <x-table-actions-dropdown 
                                    :editRoute="route('admin.stations.edit', $station)"
                                    :deleteRoute="route('admin.stations.destroy', $station)"
                                    deleteConfirm="Are you sure you want to delete this station?"
                                />
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-12 text-center text-gray-400">No stations found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layouts.app>
