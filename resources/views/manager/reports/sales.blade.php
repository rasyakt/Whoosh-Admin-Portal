<x-layouts.app :title="'Sales Report'">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Sales Report</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Ticket sales data filtered by period</p>
    </div>

    {{-- Filter --}}
    <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-5 mb-6">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">From</label>
                <input type="date" name="date_from" value="{{ $dateFrom }}" class="px-4 py-2.5 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/30 text-gray-700 dark:text-gray-200">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">To</label>
                <input type="date" name="date_to" value="{{ $dateTo }}" class="px-4 py-2.5 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/30 text-gray-700 dark:text-gray-200">
            </div>
            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-xl shadow-lg shadow-red-500/25 text-sm">Apply Filter</button>
        </form>
    </div>

    {{-- Summary Cards --}}
    @if($summary)
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 p-4">
            <p class="text-sm text-gray-500">Total Bookings</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ number_format($summary->total_bookings) }}</p>
        </div>
        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 p-4">
            <p class="text-sm text-gray-500">Total Revenue</p>
            <p class="text-2xl font-bold text-emerald-500">Rp {{ number_format($summary->total_revenue) }}</p>
        </div>
        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 p-4">
            <p class="text-sm text-gray-500">Total Passengers</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ number_format($summary->total_passengers) }}</p>
        </div>
        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 p-4">
            <p class="text-sm text-gray-500">Avg. Ticket Price</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white">Rp {{ number_format($summary->avg_ticket_price) }}</p>
        </div>
    </div>
    @endif

    {{-- Table --}}
    <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50/80 dark:bg-white/5">
                    <tr>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Code</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase">User</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Route</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Class</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Pax</th>
                        <th class="px-5 py-4 text-right text-xs font-semibold text-gray-500 uppercase">Total</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($bookings as $b)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5">
                        <td class="px-5 py-3 font-mono text-xs font-bold text-red-500">{{ $b->booking_code }}</td>
                        <td class="px-5 py-3 text-gray-600 dark:text-gray-300">{{ $b->user?->name ?? 'N/A' }}</td>
                        <td class="px-5 py-3 text-gray-600 dark:text-gray-300">{{ $b->origin_station }} → {{ $b->destination_station }}</td>
                        <td class="px-5 py-3 text-gray-500 text-xs">{{ $b->coach_class }}</td>
                        <td class="px-5 py-3 text-center text-gray-600 dark:text-gray-300">{{ $b->ticket_count }}</td>
                        <td class="px-5 py-3 text-right font-semibold text-gray-700 dark:text-gray-200">Rp {{ number_format($b->total_price) }}</td>
                        <td class="px-5 py-3 text-center">
                            <span class="px-2.5 py-1 rounded-lg text-xs font-semibold {{ match($b->status_color) { 'emerald'=>'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400','blue'=>'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400','red'=>'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',default=>'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400'} }}">{{ $b->status }}</span>
                        </td>
                        <td class="px-5 py-3 text-xs text-gray-400">{{ $b->created_at ? \Carbon\Carbon::parse($b->created_at)->format('d M Y H:i') : '—' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-5 py-12 text-center text-gray-400">No sales data for this period</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($bookings->hasPages())
        <div class="p-4 border-t border-gray-100 dark:border-white/5">{{ $bookings->withQueryString()->links() }}</div>
        @endif
    </div>
</x-layouts.app>
