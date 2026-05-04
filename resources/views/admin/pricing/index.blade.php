<x-layouts.app :title="'Pricing Management'">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Pricing Rules</h1>
            <p class="text-sm text-gray-500 mt-1">Dynamic ticket pricing by route, class, and period</p>
        </div>
        <a href="{{ route('admin.pricing.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-sm transition-colors text-sm">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Pricing Rule
        </a>
    </div>

    {{-- Filters --}}
    <div class="mb-6 flex flex-wrap gap-4">
        <form method="GET" class="relative flex-1 min-w-[200px] max-w-md">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ $search }}" placeholder="Search route..."
                class="w-full pl-12 pr-4 py-3 bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white placeholder-gray-400 shadow-sm">
            @if($classFilter)<input type="hidden" name="class" value="{{ $classFilter }}">@endif
        </form>
        <div class="flex gap-2">
            @foreach(['All' => '', 'Ekonomi' => 'Ekonomi', 'Bisnis' => 'Bisnis', 'First Class' => 'First Class'] as $label => $val)
                <a href="{{ route('admin.pricing.index', ['class' => $val, 'search' => $search]) }}"
                    class="px-5 py-2.5 rounded-lg text-sm font-semibold transition-colors flex items-center justify-center shadow-sm h-[46px] {{ ($classFilter ?? '') === $val ? 'bg-slate-800 text-white dark:bg-white dark:text-slate-900 border border-transparent' : 'bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 text-gray-600 dark:text-gray-300 hover:border-red-600 dark:hover:border-red-600' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left min-w-[1000px]">
                <thead class="bg-gray-50 dark:bg-white/5 text-slate-600 dark:text-gray-400 text-xs uppercase font-bold tracking-wider border-b border-gray-200 dark:border-white/10">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">Route</th>
                        <th class="px-6 py-4 whitespace-nowrap">Class</th>
                        <th class="px-6 py-4 text-right whitespace-nowrap">Base Price</th>
                        <th class="px-6 py-4 text-right whitespace-nowrap">Peak Price</th>
                        <th class="px-6 py-4 text-right whitespace-nowrap">Off-Peak</th>
                        <th class="px-6 py-4 text-center whitespace-nowrap">Period</th>
                        <th class="px-6 py-4 text-right whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($rules as $rule)
                    <tr class="hover:bg-gray-50/80 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200 whitespace-nowrap">{{ $rule->origin_station }} <span class="text-gray-400 mx-1">→</span> {{ $rule->destination_station }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider
                                {{ match($rule->coach_class) { 'First Class' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400', 'Bisnis' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400', default => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' } }}">
                                {{ $rule->coach_class }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-gray-200 whitespace-nowrap">Rp {{ number_format($rule->base_price) }}</td>
                        <td class="px-6 py-4 text-right text-red-600 dark:text-red-500 font-bold whitespace-nowrap">Rp {{ number_format($rule->peak_price) }}</td>
                        <td class="px-6 py-4 text-right text-emerald-600 dark:text-emerald-500 font-bold whitespace-nowrap">Rp {{ number_format($rule->off_peak_price) }}</td>
                        <td class="px-6 py-4 text-center text-xs font-medium text-gray-500 whitespace-nowrap">{{ $rule->effective_from ?? '—' }} — {{ $rule->effective_until ?? '—' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-end">
                                <x-table-actions-dropdown 
                                    :editRoute="route('admin.pricing.edit', $rule)"
                                    :deleteRoute="route('admin.pricing.destroy', $rule)"
                                    deleteConfirm="Are you sure you want to delete this pricing rule?"
                                />
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
