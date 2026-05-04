<x-layouts.app :title="'Ticket Detail'">

    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.tickets.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                Back to Tickets
            </a>
        </div>

        {{-- Ticket Header Card --}}
        <div class="bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 rounded-xl shadow-sm overflow-hidden mb-6">
            <div class="bg-red-600 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-semibold uppercase tracking-wider mb-1">Booking Code</p>
                        <h2 class="text-2xl font-black text-white font-mono tracking-wider">{{ $ticket->booking_code }}</h2>
                    </div>
                    <span class="px-4 py-2 rounded-lg text-sm font-bold uppercase tracking-wider
                        {{ match($ticket->status_color) { 'emerald' => 'bg-emerald-500/20 text-emerald-100', 'blue' => 'bg-blue-500/20 text-blue-100', 'red' => 'bg-red-900/40 text-red-100', default => 'bg-amber-500/20 text-amber-100' } }}">
                        {{ $ticket->status }}
                    </span>
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Journey Details</h3>
                    <div class="flex items-center gap-4">
                        <div class="text-center min-w-[80px]">
                            <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $ticket->departure_time }}</p>
                            <p class="text-sm font-medium text-gray-500">{{ $ticket->origin_station }}</p>
                        </div>
                        <div class="flex-1 flex flex-col items-center gap-1">
                            <span class="text-xs font-semibold text-gray-400">{{ $ticket->duration }} min</span>
                            <div class="w-full flex items-center">
                                <div class="h-[2px] flex-1 bg-gray-200 dark:bg-gray-700"></div>
                                <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                <div class="h-[2px] flex-1 bg-gray-200 dark:bg-gray-700"></div>
                            </div>
                        </div>
                        <div class="text-center min-w-[80px]">
                            <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $ticket->arrival_time }}</p>
                            <p class="text-sm font-medium text-gray-500">{{ $ticket->destination_station }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm bg-gray-50 dark:bg-[#0f0f23] p-4 rounded-lg border border-gray-100 dark:border-white/5">
                        <div><span class="text-gray-500 block mb-1">Date</span> <span class="font-bold text-slate-900 dark:text-gray-200">{{ $ticket->departure_date }}</span></div>
                        <div><span class="text-gray-500 block mb-1">Class</span> <span class="font-bold text-slate-900 dark:text-gray-200">{{ $ticket->coach_class }}</span></div>
                        <div><span class="text-gray-500 block mb-1">Carriage</span> <span class="font-bold text-slate-900 dark:text-gray-200">{{ $ticket->selected_carriage }}</span></div>
                        <div><span class="text-gray-500 block mb-1">Seats</span> <span class="font-bold text-slate-900 dark:text-gray-200">{{ $ticket->selected_seats ?: '—' }}</span></div>
                    </div>
                </div>

                <div class="space-y-5">
                    <h3 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Payment Details</h3>
                    <div class="space-y-4 text-sm bg-gray-50 dark:bg-[#0f0f23] p-5 rounded-lg border border-gray-100 dark:border-white/5">
                        <div class="flex justify-between items-center"><span class="text-gray-500 font-medium">User</span><span class="font-bold text-slate-900 dark:text-gray-200">{{ $ticket->user?->name ?? 'N/A' }}</span></div>
                        <div class="flex justify-between items-center"><span class="text-gray-500 font-medium">Email</span><span class="font-bold text-slate-900 dark:text-gray-200">{{ $ticket->user?->email ?? 'N/A' }}</span></div>
                        <div class="flex justify-between items-center"><span class="text-gray-500 font-medium">Passengers</span><span class="font-bold text-slate-900 dark:text-gray-200">{{ $ticket->ticket_count }}</span></div>
                        <div class="flex justify-between items-center"><span class="text-gray-500 font-medium">Price/Ticket</span><span class="font-bold text-slate-900 dark:text-gray-200">Rp {{ number_format($ticket->price_per_ticket) }}</span></div>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                            <span class="font-bold text-slate-900 dark:text-gray-200 uppercase tracking-wider">Total</span>
                            <span class="font-black text-xl text-red-600 dark:text-red-500">Rp {{ number_format($ticket->total_price) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Passengers --}}
        @if($ticket->passengers->count())
        <div class="bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 rounded-xl shadow-sm p-6 mb-6">
            <h3 class="font-bold text-slate-900 dark:text-white tracking-tight mb-5">Passengers</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($ticket->passengers as $p)
                <div class="flex items-center gap-4 p-4 rounded-lg bg-gray-50 dark:bg-[#0f0f23] border border-gray-100 dark:border-white/5">
                    <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 flex items-center justify-center text-lg font-bold">
                        {{ strtoupper(substr($p->name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-slate-900 dark:text-gray-200 text-sm mb-1">{{ $p->name }}</p>
                        <p class="text-xs font-medium text-gray-500">{{ $p->identity_no }} <span class="mx-1">•</span> {{ $p->passenger_type }} <span class="mx-1">•</span> Seat {{ $p->seat_number ?: '—' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Status Actions --}}
        <div class="bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 rounded-xl shadow-sm p-6">
            <h3 class="font-bold text-slate-900 dark:text-white tracking-tight mb-5">Change Status</h3>
            <div class="flex flex-wrap gap-3">
                @if(!$ticket->is_paid && !$ticket->is_cancelled)
                <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket) }}">@csrf<input type="hidden" name="action" value="pay">
                    <button class="px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 transition-colors text-sm">✓ Mark as Paid</button>
                </form>
                @endif
                @if($ticket->is_paid && !$ticket->is_used && !$ticket->is_cancelled)
                <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket) }}">@csrf<input type="hidden" name="action" value="complete">
                    <button class="px-6 py-2.5 bg-emerald-600 text-white font-semibold rounded-lg shadow-sm hover:bg-emerald-700 transition-colors text-sm">✓ Mark as Completed</button>
                </form>
                @endif
                @if(!$ticket->is_cancelled)
                <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket) }}" onsubmit="return confirm('Cancel this ticket?')">@csrf<input type="hidden" name="action" value="cancel">
                    <button class="px-6 py-2.5 bg-red-600 text-white font-semibold rounded-lg shadow-sm hover:bg-red-700 transition-colors text-sm">✕ Cancel Ticket</button>
                </form>
                @else
                <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket) }}">@csrf<input type="hidden" name="action" value="reactivate">
                    <button class="px-6 py-2.5 bg-amber-600 text-white font-semibold rounded-lg shadow-sm hover:bg-amber-700 transition-colors text-sm">↩ Reactivate</button>
                </form>
                @endif
            </div>
        </div>
    </div>

</x-layouts.app>
