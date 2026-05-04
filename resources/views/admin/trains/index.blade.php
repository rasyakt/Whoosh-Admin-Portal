<x-layouts.app :title="'Train Management'">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Trains</h1>
            <p class="text-sm text-gray-500 mt-1">Manage Whoosh train units</p>
        </div>
        <a href="{{ route('admin.trains.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-sm transition-colors text-sm">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Train
        </a>
    </div>

    <div class="mb-6">
        <form method="GET" class="relative max-w-md">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ $search }}" placeholder="Search trains..."
                class="w-full pl-12 pr-4 py-3 bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white placeholder-gray-400 shadow-sm">
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($trains as $train)
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm hover:shadow-md hover:border-gray-300 dark:hover:border-white/20 transition-all overflow-hidden">
            {{-- Header with Icon and Status --}}
            <div class="p-6 pb-4">
                <div class="flex items-start justify-between mb-5">
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800/50 text-slate-700 dark:text-slate-300 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="font-bold text-lg text-slate-900 dark:text-white truncate">{{ $train->name }}</h3>
                            <p class="text-xs font-mono font-semibold text-gray-500 dark:text-gray-400 mt-0.5">{{ $train->train_code }}</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider flex-shrink-0 ml-2
                        {{ $train->status === 'active' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : ($train->status === 'maintenance' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : 'bg-gray-100 text-gray-600 dark:bg-white/10 dark:text-gray-400') }}">
                        {{ $train->status }}
                    </span>
                </div>

                {{-- Info Grid --}}
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-gray-50 dark:bg-white/5 rounded-lg p-4 border border-gray-100 dark:border-white/5">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Capacity</p>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $train->capacity }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">seats</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-white/5 rounded-lg p-4 border border-gray-100 dark:border-white/5">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Class</p>
                        <p class="text-xl font-bold text-slate-900 dark:text-white truncate">{{ $train->class_type }}</p>
                    </div>
                </div>

                {{-- Description --}}
                @if($train->description)
                <div class="pt-4 border-t border-gray-100 dark:border-white/10">
                    <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 leading-relaxed">{{ $train->description }}</p>
                </div>
                @endif
            </div>

            {{-- Actions Footer --}}
            <div class="bg-gray-50 dark:bg-white/5 px-6 py-3.5 flex items-center gap-2 border-t border-gray-100 dark:border-white/10">
                <a href="{{ route('admin.trains.edit', $train) }}" class="flex-1 py-2.5 text-center text-sm font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-all">
                    Edit
                </a>
                <div class="w-px h-6 bg-gray-200 dark:bg-white/10"></div>
                <form method="POST" action="{{ route('admin.trains.destroy', $train) }}" onsubmit="return confirm('Are you sure you want to delete this train?')" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-2.5 text-center text-sm font-semibold text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 dark:bg-white/5 mb-4">
                <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <p class="text-gray-500 dark:text-gray-400 font-semibold text-lg">No trains found</p>
            <p class="text-sm text-gray-400 dark:text-gray-500 mt-2">Add your first train to get started</p>
        </div>
        @endforelse
    </div>

</x-layouts.app>
