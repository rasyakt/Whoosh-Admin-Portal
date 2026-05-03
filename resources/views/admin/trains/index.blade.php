<x-layouts.app :title="'Train Management'">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Trains</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage Whoossh train units</p>
        </div>
        <a href="{{ route('admin.trains.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl shadow-lg shadow-red-500/25 hover:shadow-red-500/40 transition-all duration-200 text-sm">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
            Add Train
        </a>
    </div>

    <div class="mb-6">
        <form method="GET" class="relative max-w-md">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ $search }}" placeholder="Search trains..."
                class="w-full pl-12 pr-4 py-3 bg-white dark:bg-[#1e1e3a] border border-gray-200 dark:border-white/10 rounded-xl text-gray-700 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:border-red-500/30 transition-all text-sm">
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse($trains as $train)
        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-5 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-lg shadow-amber-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 dark:text-white">{{ $train->name }}</h3>
                        <p class="text-xs font-mono text-gray-400">{{ $train->train_code }}</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold
                    {{ $train->status === 'active' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : ($train->status === 'maintenance' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : 'bg-gray-100 text-gray-600 dark:bg-white/10 dark:text-gray-400') }}">
                    {{ ucfirst($train->status) }}
                </span>
            </div>

            <div class="space-y-2 mb-4">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 dark:text-gray-400">Capacity</span>
                    <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $train->capacity }} seats</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 dark:text-gray-400">Class</span>
                    <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $train->class_type }}</span>
                </div>
                @if($train->description)
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-2 line-clamp-2">{{ $train->description }}</p>
                @endif
            </div>

            <div class="flex items-center gap-2 pt-3 border-t border-gray-100 dark:border-white/5">
                <a href="{{ route('admin.trains.edit', $train) }}" class="flex-1 py-2 text-center text-sm font-medium text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors">Edit</a>
                <form method="POST" action="{{ route('admin.trains.destroy', $train) }}" onsubmit="return confirm('Delete this train?')" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-2 text-center text-sm font-medium text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">Delete</button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-400">No trains found</div>
        @endforelse
    </div>

</x-layouts.app>
