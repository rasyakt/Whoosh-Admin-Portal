<x-layouts.app :title="'User Detail'">
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-red-500 transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 19l-7-7 7-7"/></svg> Back to Users
        </a>

        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-6 mb-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-xl font-bold shadow-lg">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $user->email }} · {{ $user->phone }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $user->bookings_count }} total bookings</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 dark:border-white/5"><h3 class="font-bold text-gray-800 dark:text-white">Recent Bookings</h3></div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50/80 dark:bg-white/5">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Code</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Route</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Date</th>
                            <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Status</th>
                            <th class="px-5 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($bookings as $b)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5">
                            <td class="px-5 py-3"><a href="{{ route('admin.tickets.show', $b) }}" class="font-mono text-xs font-bold text-red-500 hover:underline">{{ $b->booking_code }}</a></td>
                            <td class="px-5 py-3 text-gray-600 dark:text-gray-300">{{ $b->origin_station }} → {{ $b->destination_station }}</td>
                            <td class="px-5 py-3 text-gray-500 text-xs">{{ $b->departure_date }}</td>
                            <td class="px-5 py-3 text-center">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold {{ match($b->status_color) { 'emerald'=>'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400','blue'=>'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400','red'=>'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',default=>'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400'} }}">{{ $b->status }}</span>
                            </td>
                            <td class="px-5 py-3 text-right font-semibold text-gray-700 dark:text-gray-200">Rp {{ number_format($b->total_price) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-5 py-8 text-center text-gray-400">No bookings</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
