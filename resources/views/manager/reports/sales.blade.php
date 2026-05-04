<x-layouts.app :title="'Sales Report'">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Sales Report</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Comprehensive ticket sales data with period filtering</p>
    </div>

    {{-- Filter Card --}}
    <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm p-6 mb-8">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-semibold text-slate-700 dark:text-gray-300 mb-2 uppercase tracking-wider">From Date</label>
                <input type="date" name="date_from" value="{{ $dateFrom }}" 
                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition-all text-slate-900 dark:text-white">
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-semibold text-slate-700 dark:text-gray-300 mb-2 uppercase tracking-wider">To Date</label>
                <input type="date" name="date_to" value="{{ $dateTo }}" 
                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition-all text-slate-900 dark:text-white">
            </div>
            <button type="submit" class="px-8 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-sm transition-colors text-sm h-[42px] flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                Apply Filter
            </button>
        </form>
    </div>

    {{-- Summary Cards --}}
    @if($summary)
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-slate-100 dark:bg-slate-800/50 text-slate-700 dark:text-slate-300 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Bookings</p>
            </div>
            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($summary->total_bookings) }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-slate-100 dark:bg-slate-800/50 text-slate-700 dark:text-slate-300 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Revenue</p>
            </div>
            <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-500 whitespace-nowrap">Rp&nbsp;{{ number_format($summary->total_revenue) }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-slate-100 dark:bg-slate-800/50 text-slate-700 dark:text-slate-300 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Passengers</p>
            </div>
            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($summary->total_passengers) }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg bg-slate-100 dark:bg-slate-800/50 text-slate-700 dark:text-slate-300 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Avg. Price</p>
            </div>
            <p class="text-2xl font-bold text-slate-900 dark:text-white whitespace-nowrap">Rp&nbsp;{{ number_format($summary->avg_ticket_price) }}</p>
        </div>
    </div>
    @endif

    {{-- Table --}}
    <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100 dark:border-white/10">
            <h3 class="font-bold text-slate-900 dark:text-white tracking-tight">Sales Transactions</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left min-w-[1100px]">
                <thead class="bg-gray-50 dark:bg-white/5 text-slate-600 dark:text-gray-400 text-xs uppercase font-bold tracking-wider border-b border-gray-200 dark:border-white/10">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">Booking Code</th>
                        <th class="px-6 py-4 whitespace-nowrap">Customer</th>
                        <th class="px-6 py-4 whitespace-nowrap">Route</th>
                        <th class="px-6 py-4 whitespace-nowrap">Class</th>
                        <th class="px-6 py-4 text-center whitespace-nowrap">Passengers</th>
                        <th class="px-6 py-4 text-right whitespace-nowrap">Total Price</th>
                        <th class="px-6 py-4 text-center whitespace-nowrap">Status</th>
                        <th class="px-6 py-4 whitespace-nowrap">Booking Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($bookings as $b)
                    <tr class="hover:bg-gray-50/80 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs font-bold text-slate-700 dark:text-gray-300 whitespace-nowrap">{{ $b->booking_code }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200 whitespace-nowrap">{{ $b->user?->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-gray-400 whitespace-nowrap">
                            <span class="font-medium">{{ $b->origin_station }}</span>
                            <span class="text-gray-400 mx-1.5">→</span>
                            <span class="font-medium">{{ $b->destination_station }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 rounded-md text-xs font-semibold bg-gray-100 dark:bg-white/10 text-slate-700 dark:text-gray-300">{{ $b->coach_class }}</span>
                        </td>
                        <td class="px-6 py-4 text-center font-bold text-slate-700 dark:text-gray-300 whitespace-nowrap">{{ $b->ticket_count }}</td>
                        <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-white whitespace-nowrap">Rp&nbsp;{{ number_format($b->total_price) }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <span class="inline-flex px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider {{ match($b->status_color) { 'emerald'=>'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400','blue'=>'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400','red'=>'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',default=>'bg-gray-100 text-gray-700 dark:bg-white/10 dark:text-gray-400'} }}">
                                {{ $b->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs font-medium text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $b->created_at ? \Carbon\Carbon::parse($b->created_at)->format('d M Y, H:i') : '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 font-medium">No sales data for this period</p>
                                <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Try adjusting your date filter</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($bookings->hasPages())
        <div class="p-4 border-t border-gray-100 dark:border-white/10">{{ $bookings->withQueryString()->links() }}</div>
        @endif
    </div>
</x-layouts.app>
