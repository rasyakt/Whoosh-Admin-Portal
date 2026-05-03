<x-layouts.app :title="'Pricing Management'">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Pricing Rules</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Dynamic ticket pricing by route, class, and period</p>
        </div>
        <a href="{{ route('admin.pricing.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl shadow-lg shadow-red-500/25 transition-all text-sm">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
            Add Pricing Rule
        </a>
    </div>

    {{-- Filters --}}
    <div class="mb-6 flex flex-wrap gap-3">
        <form method="GET" class="relative flex-1 min-w-[200px] max-w-md">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ $search }}" placeholder="Search route..."
                class="w-full pl-12 pr-4 py-3 bg-white dark:bg-[#1e1e3a] border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-gray-700 dark:text-gray-200 placeholder-gray-400">
            @if($classFilter)<input type="hidden" name="class" value="{{ $classFilter }}">@endif
        </form>
        <div class="flex gap-2">
            @foreach(['All' => '', 'Ekonomi' => 'Ekonomi', 'Bisnis' => 'Bisnis', 'First Class' => 'First Class'] as $label => $val)
                <a href="{{ route('admin.pricing.index', ['class' => $val, 'search' => $search]) }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-medium transition-all {{ ($classFilter ?? '') === $val ? 'bg-red-500 text-white shadow-lg shadow-red-500/25' : 'bg-white dark:bg-[#1e1e3a] border border-gray-200 dark:border-white/10 text-gray-600 dark:text-gray-300 hover:border-red-300' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50/80 dark:bg-white/5">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Route</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Class</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Base Price</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Peak Price</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Off-Peak</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Period</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($rules as $rule)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-700 dark:text-gray-200">{{ $rule->origin_station }} → {{ $rule->destination_station }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-lg text-xs font-semibold
                                {{ match($rule->coach_class) { 'First Class' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400', 'Bisnis' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400', default => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' } }}">
                                {{ $rule->coach_class }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right font-semibold text-gray-700 dark:text-gray-200">Rp {{ number_format($rule->base_price) }}</td>
                        <td class="px-6 py-4 text-right text-red-500 font-semibold">Rp {{ number_format($rule->peak_price) }}</td>
                        <td class="px-6 py-4 text-right text-emerald-500 font-semibold">Rp {{ number_format($rule->off_peak_price) }}</td>
                        <td class="px-6 py-4 text-center text-xs text-gray-400">{{ $rule->effective_from ?? '—' }} — {{ $rule->effective_until ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.pricing.edit', $rule) }}" class="p-2 rounded-lg text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.pricing.destroy', $rule) }}" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-6 py-12 text-center text-gray-400">No pricing rules found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layouts.app>
