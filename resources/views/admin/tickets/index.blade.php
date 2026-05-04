<x-layouts.app :title="'Ticket Control'">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Ticket Status Control</h1>
        <p class="text-sm text-gray-500 mt-1">Manage booking statuses — changes sync with the mobile app in real-time</p>
    </div>

    {{-- Filters --}}
    <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm p-5 mb-6">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Search</label>
                <input type="text" name="search" value="{{ $search }}" placeholder="Booking code, station, or user..."
                    class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white placeholder-gray-400">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Status</label>
                <select name="status" class="px-4 py-2.5 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white min-w-[150px]">
                    <option value="">All Status</option>
                    <option value="booked" {{ $status === 'booked' ? 'selected' : '' }}>Booked (Unpaid)</option>
                    <option value="paid" {{ $status === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">From</label>
                <input type="date" name="date_from" value="{{ $dateFrom }}"
                    class="px-4 py-2.5 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">To</label>
                <input type="date" name="date_to" value="{{ $dateTo }}"
                    class="px-4 py-2.5 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
            </div>
            <button type="submit" class="px-6 py-2.5 bg-red-600 text-white font-semibold rounded-lg shadow-sm text-sm hover:bg-red-700 transition-colors">Filter</button>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left min-w-[1200px]">
                <thead class="bg-gray-50 dark:bg-white/5 text-slate-600 dark:text-gray-400 text-xs uppercase font-bold tracking-wider border-b border-gray-200 dark:border-white/10">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">Booking Code</th>
                        <th class="px-6 py-4 whitespace-nowrap">User</th>
                        <th class="px-6 py-4 whitespace-nowrap">Route</th>
                        <th class="px-6 py-4 whitespace-nowrap">Date</th>
                        <th class="px-6 py-4 whitespace-nowrap">Class</th>
                        <th class="px-6 py-4 text-right whitespace-nowrap">Total</th>
                        <th class="px-6 py-4 text-center whitespace-nowrap">Status</th>
                        <th class="px-6 py-4 text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($bookings as $b)
                    <tr class="hover:bg-gray-50/80 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.tickets.show', $b) }}" class="font-mono font-bold text-xs text-red-600 hover:text-red-700 hover:underline">{{ $b->booking_code }}</a>
                        </td>
                        <td class="px-6 py-4 text-slate-900 dark:text-gray-200 font-medium whitespace-nowrap">{{ $b->user?->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-slate-700 dark:text-gray-300 whitespace-nowrap">{{ $b->origin_station }} <span class="text-gray-400 mx-1">→</span> {{ $b->destination_station }}</td>
                        <td class="px-6 py-4 text-gray-500 text-xs whitespace-nowrap">{{ $b->departure_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap"><span class="text-xs font-semibold text-gray-500">{{ $b->coach_class }}</span></td>
                        <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-gray-200 whitespace-nowrap">Rp {{ number_format($b->total_price) }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <span class="inline-flex px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider
                                {{ match($b->status_color) { 'emerald' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400', 'blue' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400', 'red' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400', default => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' } }}">
                                {{ $b->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <div class="relative inline-block text-left" x-data="{ open: false, dropup: false }" @click.away="open = false">
                                    <!-- Trigger Button -->
                                    <button @click="open = !open; 
                                                    $nextTick(() => {
                                                        if (open) {
                                                            const button = $el.getBoundingClientRect();
                                                            const dropdown = $el.nextElementSibling;
                                                            
                                                            setTimeout(() => {
                                                                const dropdownHeight = dropdown.offsetHeight || 250;
                                                                const spaceBelow = window.innerHeight - button.bottom;
                                                                const spaceAbove = button.top;
                                                                
                                                                dropup = (spaceBelow - 20) < dropdownHeight && (spaceAbove - 20) > dropdownHeight;
                                                            }, 10);
                                                        }
                                                    })" 
                                            type="button" 
                                            class="p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-white/10 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                        </svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div x-show="open" 
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         @click="open = false"
                                         :class="dropup ? 'bottom-full mb-2' : 'top-full mt-2'"
                                         class="absolute right-0 z-[9999] w-48 origin-top-right rounded-lg bg-white dark:bg-[#1a1a2e] shadow-xl ring-1 ring-black ring-opacity-5 border border-gray-200 dark:border-white/10"
                                         style="display: none;">
                                        <div class="py-1">
                                            <a href="{{ route('admin.tickets.show', $b) }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View Details
                                            </a>

                                            @if(!$b->is_paid && !$b->is_cancelled)
                                            <form method="POST" action="{{ route('admin.tickets.updateStatus', $b) }}">
                                                @csrf
                                                <input type="hidden" name="action" value="pay">
                                                <button type="submit" class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                    </svg>
                                                    Mark as Paid
                                                </button>
                                            </form>
                                            @endif

                                            @if($b->is_paid && !$b->is_used && !$b->is_cancelled)
                                            <form method="POST" action="{{ route('admin.tickets.updateStatus', $b) }}">
                                                @csrf
                                                <input type="hidden" name="action" value="complete">
                                                <button type="submit" class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm text-emerald-600 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    Mark Complete
                                                </button>
                                            </form>
                                            @endif

                                            @if(!$b->is_cancelled)
                                            <form method="POST" action="{{ route('admin.tickets.updateStatus', $b) }}" onsubmit="return confirm('Cancel this ticket?')">
                                                @csrf
                                                <input type="hidden" name="action" value="cancel">
                                                <button type="submit" class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    Cancel Ticket
                                                </button>
                                            </form>
                                            @else
                                            <form method="POST" action="{{ route('admin.tickets.updateStatus', $b) }}">
                                                @csrf
                                                <input type="hidden" name="action" value="reactivate">
                                                <button type="submit" class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                    </svg>
                                                    Reactivate
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-6 py-12 text-center text-gray-400 font-medium">No tickets found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($bookings->hasPages())
        <div class="p-4 border-t border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/5">
            {{ $bookings->withQueryString()->links() }}
        </div>
        @endif
    </div>

</x-layouts.app>
