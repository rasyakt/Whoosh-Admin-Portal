<x-layouts.app :title="'Sales Report'">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Sales Report</h1>
        <p class="text-sm text-gray-500 mt-1">Ticket sales data filtered by period</p>
    </div>

    {{-- Filter --}}
    <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm p-5 mb-6">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-gray-400 mb-1.5 uppercase tracking-wider">From Date</label>
                <input type="date" name="date_from" value="{{ $dateFrom }}" class="px-4 py-2.5 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 dark:text-gray-400 mb-1.5 uppercase tracking-wider">To Date</label>
                <input type="date" name="date_to" value="{{ $dateTo }}" class="px-4 py-2.5 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
            </div>
            <button type="submit" class="px-6 py-2.5 bg-slate-800 hover:bg-slate-900 dark:bg-white dark:hover:bg-gray-100 dark:text-slate-900 text-white font-semibold rounded-lg shadow-sm transition-colors text-sm h-[42px]">
                Apply Filter
            </button>
        </form>
    </div>

    {{-- Summary Cards --}}
    @if($summary)
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 p-6 shadow-sm">
            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Total Bookings</p>
            <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ number_format($summary->total_bookings) }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 p-6 shadow-sm">
            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Total Revenue</p>
            <p class="text-3xl font-bold text-emerald-600">Rp {{ number_format($summary->total_revenue) }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 p-6 shadow-sm">
            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Total Passengers</p>
            <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ number_format($summary->total_passengers) }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 p-6 shadow-sm">
            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Avg. Ticket Price</p>
            <p class="text-3xl font-bold text-slate-900 dark:text-white">Rp {{ number_format($summary->avg_ticket_price) }}</p>
        </div>
    </div>
    @endif

    {{-- Table --}}
    <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left min-w-[1100px]">
                <thead class="bg-gray-50 dark:bg-white/5 text-slate-600 dark:text-gray-400 text-xs uppercase font-bold tracking-wider border-b border-gray-200 dark:border-white/10">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">Code</th>
                        <th class="px-6 py-4 whitespace-nowrap">User</th>
                        <th class="px-6 py-4 whitespace-nowrap">Route</th>
                        <th class="px-6 py-4 whitespace-nowrap">Class</th>
                        <th class="px-6 py-4 text-center whitespace-nowrap">Pax</th>
                        <th class="px-6 py-4 text-right whitespace-nowrap">Total</th>
                        <th class="px-6 py-4 text-center whitespace-nowrap">Status</th>
                        <th class="px-6 py-4 whitespace-nowrap">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($bookings as $b)
                    <tr class="hover:bg-gray-50/80 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs font-bold text-slate-700 dark:text-gray-300 whitespace-nowrap">{{ $b->booking_code }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200 whitespace-nowrap">{{ $b->user?->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-gray-400 whitespace-nowrap">{{ $b->origin_station }} <span class="text-gray-400 mx-1">→</span> {{ $b->destination_station }}</td>
                        <td class="px-6 py-4 text-slate-500 text-xs font-semibold whitespace-nowrap">{{ $b->coach_class }}</td>
                        <td class="px-6 py-4 text-center font-medium text-slate-700 dark:text-gray-300 whitespace-nowrap">{{ $b->ticket_count }}</td>
                        <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-white whitespace-nowrap">Rp {{ number_format($b->total_price) }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <span class="px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider {{ match($b->status_color) { 'emerald'=>'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400','blue'=>'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400','red'=>'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',default=>'bg-gray-100 text-gray-700 dark:bg-white/10 dark:text-gray-400'} }}">
                                {{ $b->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs font-medium text-gray-500 whitespace-nowrap">{{ $b->created_at ? \Carbon\Carbon::parse($b->created_at)->format('d M Y H:i') : '—' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-6 py-12 text-center text-gray-400">No sales data for this period</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($bookings->hasPages())
        <div class="p-4 border-t border-gray-100 dark:border-white/10">{{ $bookings->withQueryString()->links() }}</div>
        @endif
    </div>
</x-layouts.app>
