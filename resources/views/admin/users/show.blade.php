<x-layouts.app :title="'User Detail'">
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-red-600 transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg> Back to Users
        </a>

        <div class="bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 rounded-xl shadow-sm p-6 mb-6">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-700 dark:text-blue-400 text-xl font-bold">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white tracking-tight">{{ $user->name }}</h2>
                    <p class="text-sm font-medium text-gray-500">{{ $user->email }} <span class="mx-1">•</span> {{ $user->phone }}</p>
                    <div class="mt-2 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-gray-50 dark:bg-[#0f0f23] border border-gray-100 dark:border-white/5">
                        <span class="font-bold text-slate-900 dark:text-gray-200 text-sm">{{ $user->bookings_count }}</span>
                        <span class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Total Bookings</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 rounded-xl shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 dark:border-white/10"><h3 class="font-bold text-slate-900 dark:text-white tracking-tight">Recent Bookings</h3></div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left min-w-[700px]">
                    <thead class="bg-gray-50 dark:bg-white/5 text-slate-600 dark:text-gray-400 text-xs uppercase font-bold tracking-wider border-b border-gray-200 dark:border-white/10">
                        <tr>
                            <th class="px-6 py-4 whitespace-nowrap">Code</th>
                            <th class="px-6 py-4 whitespace-nowrap">Route</th>
                            <th class="px-6 py-4 whitespace-nowrap">Date</th>
                            <th class="px-6 py-4 text-center whitespace-nowrap">Status</th>
                            <th class="px-6 py-4 text-right whitespace-nowrap">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($bookings as $b)
                        <tr class="hover:bg-gray-50/80 dark:hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap"><a href="{{ route('admin.tickets.show', $b) }}" class="font-mono text-xs font-bold text-red-600 hover:text-red-700 hover:underline">{{ $b->booking_code }}</a></td>
                            <td class="px-6 py-4 text-slate-700 dark:text-gray-300 whitespace-nowrap">{{ $b->origin_station }} <span class="text-gray-400 mx-1">→</span> {{ $b->destination_station }}</td>
                            <td class="px-6 py-4 text-gray-500 text-xs whitespace-nowrap">{{ $b->departure_date }}</td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider {{ match($b->status_color) { 'emerald'=>'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400','blue'=>'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400','red'=>'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',default=>'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400'} }}">{{ $b->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-gray-200 whitespace-nowrap">Rp {{ number_format($b->total_price) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400 font-medium">No bookings</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
