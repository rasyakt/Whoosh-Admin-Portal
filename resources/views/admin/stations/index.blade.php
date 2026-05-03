<x-layouts.app :title="'Station Management'">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Stations</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage all train stations in the Whoossh network</p>
        </div>
        <a href="{{ route('admin.stations.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl shadow-lg shadow-red-500/25 hover:shadow-red-500/40 transition-all duration-200 text-sm">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
            Add Station
        </a>
    </div>

    {{-- Search --}}
    <div class="mb-6">
        <form method="GET" class="relative max-w-md">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ $search }}" placeholder="Search stations..."
                class="w-full pl-12 pr-4 py-3 bg-white dark:bg-[#1e1e3a] border border-gray-200 dark:border-white/10 rounded-xl text-gray-700 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:border-red-500/30 transition-all text-sm">
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50/80 dark:bg-white/5">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Station Name</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Code</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Facilities</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($stations as $station)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 text-gray-400 font-mono text-xs">{{ $station->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                    {{ strtoupper(substr($station->code ?? $station->name, 0, 2)) }}
                                </div>
                                <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $station->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-gray-100 dark:bg-white/10 rounded-lg text-xs font-mono font-semibold text-gray-600 dark:text-gray-300">{{ $station->code }}</span></td>
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400">{{ $station->location ?? '—' }}</td>
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400 max-w-[200px] truncate">{{ $station->facilities ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.stations.edit', $station) }}" class="p-2 rounded-lg text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors" title="Edit">
                                    <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.stations.destroy', $station) }}" onsubmit="return confirm('Delete this station?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors" title="Delete">
                                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
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
