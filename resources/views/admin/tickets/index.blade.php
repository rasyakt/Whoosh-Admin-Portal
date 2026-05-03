<x-layouts.app :title="'Ticket Control'">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Ticket Status Control</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage booking statuses — changes sync with the mobile app in real-time</p>
    </div>

    {{-- Filters --}}
    <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-5 mb-6">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Search</label>
                <input type="text" name="search" value="{{ $search }}" placeholder="Booking code, station, or user..."
                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-gray-700 dark:text-gray-200 placeholder-gray-400">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Status</label>
                <select name="status" class="px-4 py-2.5 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-gray-700 dark:text-gray-200">
                    <option value="">All Status</option>
                    <option value="booked" {{ $status === 'booked' ? 'selected' : '' }}>Booked (Unpaid)</option>
                    <option value="paid" {{ $status === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">From</label>
                <input type="date" name="date_from" value="{{ $dateFrom }}"
                    class="px-4 py-2.5 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-gray-700 dark:text-gray-200">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">To</label>
                <input type="date" name="date_to" value="{{ $dateTo }}"
                    class="px-4 py-2.5 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-gray-700 dark:text-gray-200">
            </div>
            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-xl shadow-lg shadow-red-500/25 text-sm hover:from-red-600 hover:to-red-700 transition-all">Filter</button>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50/80 dark:bg-white/5">
                    <tr>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Booking Code</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">User</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Route</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Date</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Class</th>
                        <th class="px-5 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Total</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Status</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($bookings as $b)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-5 py-3">
                            <a href="{{ route('admin.tickets.show', $b) }}" class="font-mono font-bold text-xs text-red-500 hover:text-red-600 hover:underline">{{ $b->booking_code }}</a>
                        </td>
                        <td class="px-5 py-3 text-gray-600 dark:text-gray-300">{{ $b->user?->name ?? 'N/A' }}</td>
                        <td class="px-5 py-3 text-gray-600 dark:text-gray-300">{{ $b->origin_station }} → {{ $b->destination_station }}</td>
                        <td class="px-5 py-3 text-gray-500 dark:text-gray-400 text-xs">{{ $b->departure_date }}</td>
                        <td class="px-5 py-3"><span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ $b->coach_class }}</span></td>
                        <td class="px-5 py-3 text-right font-semibold text-gray-700 dark:text-gray-200">Rp {{ number_format($b->total_price) }}</td>
                        <td class="px-5 py-3 text-center">
                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-semibold
                                {{ match($b->status_color) { 'emerald' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400', 'blue' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400', 'red' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400', default => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' } }}">
                                {{ $b->status }}
                            </span>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-center gap-1">
                                @if(!$b->is_paid && !$b->is_cancelled)
                                <form method="POST" action="{{ route('admin.tickets.updateStatus', $b) }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="action" value="pay">
                                    <button class="px-2.5 py-1.5 text-xs font-medium text-blue-600 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors" title="Mark as Paid">Pay</button>
                                </form>
                                @endif
                                @if($b->is_paid && !$b->is_used && !$b->is_cancelled)
                                <form method="POST" action="{{ route('admin.tickets.updateStatus', $b) }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="action" value="complete">
                                    <button class="px-2.5 py-1.5 text-xs font-medium text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg hover:bg-emerald-100 dark:hover:bg-emerald-900/40 transition-colors" title="Mark Complete">Done</button>
                                </form>
                                @endif
                                @if(!$b->is_cancelled)
                                <form method="POST" action="{{ route('admin.tickets.updateStatus', $b) }}" class="inline" onsubmit="return confirm('Cancel this ticket?')">
                                    @csrf
                                    <input type="hidden" name="action" value="cancel">
                                    <button class="px-2.5 py-1.5 text-xs font-medium text-red-600 bg-red-50 dark:bg-red-900/20 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors" title="Cancel">✕</button>
                                </form>
                                @else
                                <form method="POST" action="{{ route('admin.tickets.updateStatus', $b) }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="action" value="reactivate">
                                    <button class="px-2.5 py-1.5 text-xs font-medium text-amber-600 bg-amber-50 dark:bg-amber-900/20 rounded-lg hover:bg-amber-100 dark:hover:bg-amber-900/40 transition-colors" title="Reactivate">↩</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-5 py-12 text-center text-gray-400">No tickets found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($bookings->hasPages())
        <div class="p-4 border-t border-gray-100 dark:border-white/5">
            {{ $bookings->withQueryString()->links() }}
        </div>
        @endif
    </div>

</x-layouts.app>
