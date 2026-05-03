<x-layouts.app :title="'Ticket Detail'">

    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.tickets.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-red-500 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 19l-7-7 7-7"/></svg>
                Back to Tickets
            </a>
        </div>

        {{-- Ticket Header Card --}}
        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-red-500 to-red-600 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium">Booking Code</p>
                        <h2 class="text-2xl font-black text-white font-mono tracking-wider">{{ $ticket->booking_code }}</h2>
                    </div>
                    <span class="px-4 py-2 rounded-xl text-sm font-bold
                        {{ match($ticket->status_color) { 'emerald' => 'bg-emerald-500/20 text-emerald-100', 'blue' => 'bg-blue-500/20 text-blue-100', 'red' => 'bg-red-900/40 text-red-100', default => 'bg-amber-500/20 text-amber-100' } }}">
                        {{ $ticket->status }}
                    </span>
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Journey Details</h3>
                    <div class="flex items-center gap-4">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $ticket->departure_time }}</p>
                            <p class="text-sm text-gray-500">{{ $ticket->origin_station }}</p>
                        </div>
                        <div class="flex-1 flex items-center gap-2">
                            <div class="h-px flex-1 bg-gray-300 dark:bg-gray-600"></div>
                            <span class="text-xs text-gray-400 font-medium">{{ $ticket->duration }} min</span>
                            <div class="h-px flex-1 bg-gray-300 dark:bg-gray-600"></div>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $ticket->arrival_time }}</p>
                            <p class="text-sm text-gray-500">{{ $ticket->destination_station }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div><span class="text-gray-400">Date:</span> <span class="font-medium text-gray-700 dark:text-gray-200">{{ $ticket->departure_date }}</span></div>
                        <div><span class="text-gray-400">Class:</span> <span class="font-medium text-gray-700 dark:text-gray-200">{{ $ticket->coach_class }}</span></div>
                        <div><span class="text-gray-400">Carriage:</span> <span class="font-medium text-gray-700 dark:text-gray-200">{{ $ticket->selected_carriage }}</span></div>
                        <div><span class="text-gray-400">Seats:</span> <span class="font-medium text-gray-700 dark:text-gray-200">{{ $ticket->selected_seats ?: '—' }}</span></div>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Payment Details</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between"><span class="text-gray-400">User</span><span class="font-medium text-gray-700 dark:text-gray-200">{{ $ticket->user?->name ?? 'N/A' }}</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Email</span><span class="font-medium text-gray-700 dark:text-gray-200">{{ $ticket->user?->email ?? 'N/A' }}</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Passengers</span><span class="font-medium text-gray-700 dark:text-gray-200">{{ $ticket->ticket_count }}</span></div>
                        <div class="flex justify-between"><span class="text-gray-400">Price/Ticket</span><span class="font-medium text-gray-700 dark:text-gray-200">Rp {{ number_format($ticket->price_per_ticket) }}</span></div>
                        <div class="flex justify-between pt-2 border-t border-gray-100 dark:border-white/5"><span class="font-semibold text-gray-700 dark:text-gray-200">Total</span><span class="font-bold text-lg text-red-500">Rp {{ number_format($ticket->total_price) }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Passengers --}}
        @if($ticket->passengers->count())
        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-5 mb-6">
            <h3 class="font-bold text-gray-800 dark:text-white mb-4">Passengers</h3>
            <div class="space-y-3">
                @foreach($ticket->passengers as $p)
                <div class="flex items-center gap-4 p-3 rounded-xl bg-gray-50 dark:bg-white/5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-sm font-bold">{{ strtoupper(substr($p->name, 0, 1)) }}</div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-700 dark:text-gray-200 text-sm">{{ $p->name }}</p>
                        <p class="text-xs text-gray-400">{{ $p->identity_no }} · {{ $p->passenger_type }} · Seat {{ $p->seat_number ?: '—' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Status Actions --}}
        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 dark:text-white mb-4">Change Status</h3>
            <div class="flex flex-wrap gap-3">
                @if(!$b = null)@endif
                @if(!$ticket->is_paid && !$ticket->is_cancelled)
                <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket) }}">@csrf<input type="hidden" name="action" value="pay">
                    <button class="px-5 py-2.5 bg-blue-500 text-white font-semibold rounded-xl shadow-lg shadow-blue-500/25 hover:bg-blue-600 transition-all text-sm">✓ Mark as Paid</button>
                </form>
                @endif
                @if($ticket->is_paid && !$ticket->is_used && !$ticket->is_cancelled)
                <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket) }}">@csrf<input type="hidden" name="action" value="complete">
                    <button class="px-5 py-2.5 bg-emerald-500 text-white font-semibold rounded-xl shadow-lg shadow-emerald-500/25 hover:bg-emerald-600 transition-all text-sm">✓ Mark as Completed</button>
                </form>
                @endif
                @if(!$ticket->is_cancelled)
                <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket) }}" onsubmit="return confirm('Cancel this ticket?')">@csrf<input type="hidden" name="action" value="cancel">
                    <button class="px-5 py-2.5 bg-red-500 text-white font-semibold rounded-xl shadow-lg shadow-red-500/25 hover:bg-red-600 transition-all text-sm">✕ Cancel Ticket</button>
                </form>
                @else
                <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket) }}">@csrf<input type="hidden" name="action" value="reactivate">
                    <button class="px-5 py-2.5 bg-amber-500 text-white font-semibold rounded-xl shadow-lg shadow-amber-500/25 hover:bg-amber-600 transition-all text-sm">↩ Reactivate</button>
                </form>
                @endif
            </div>
        </div>
    </div>

</x-layouts.app>
