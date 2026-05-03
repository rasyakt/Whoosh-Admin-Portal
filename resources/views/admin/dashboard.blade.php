<x-layouts.app :title="'Admin Dashboard'">

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
        <x-stat-card label="Total Users" :value="$stats['total_users']" color="blue" icon="users" />
        <x-stat-card label="Total Revenue" :value="'Rp ' . number_format($stats['total_revenue'])" color="emerald" icon="revenue" />
        <x-stat-card label="Active Trains" :value="$stats['active_trains']" color="amber" icon="train" />
        <x-stat-card label="Total Stations" :value="$stats['total_stations']" color="violet" icon="station" />
    </div>

    {{-- Ticket Status Row --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="p-4 rounded-2xl bg-amber-50 dark:bg-amber-900/10 border border-amber-200/50 dark:border-amber-800/30">
            <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $stats['pending_tickets'] }}</p>
            <p class="text-sm text-amber-600/70 dark:text-amber-400/70 mt-1">Pending Tickets</p>
        </div>
        <div class="p-4 rounded-2xl bg-blue-50 dark:bg-blue-900/10 border border-blue-200/50 dark:border-blue-800/30">
            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['paid_tickets'] }}</p>
            <p class="text-sm text-blue-600/70 dark:text-blue-400/70 mt-1">Paid Tickets</p>
        </div>
        <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-200/50 dark:border-emerald-800/30">
            <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $stats['completed_tickets'] }}</p>
            <p class="text-sm text-emerald-600/70 dark:text-emerald-400/70 mt-1">Completed</p>
        </div>
        <div class="p-4 rounded-2xl bg-red-50 dark:bg-red-900/10 border border-red-200/50 dark:border-red-800/30">
            <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $stats['cancelled_tickets'] }}</p>
            <p class="text-sm text-red-600/70 dark:text-red-400/70 mt-1">Cancelled</p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        {{-- Recent Bookings --}}
        <div class="xl:col-span-2 bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 dark:border-white/5 flex items-center justify-between">
                <h3 class="font-bold text-gray-800 dark:text-white">Recent Bookings</h3>
                <a href="{{ route('admin.tickets.index') }}" class="text-sm text-red-500 hover:text-red-600 font-medium">View All →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50/50 dark:bg-white/5">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Code</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Route</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">User</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Status</th>
                            <th class="px-5 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Price</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($recentBookings as $b)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                            <td class="px-5 py-3 font-mono font-semibold text-xs text-red-500">{{ $b->booking_code }}</td>
                            <td class="px-5 py-3 text-gray-600 dark:text-gray-300">{{ $b->origin_station }} → {{ $b->destination_station }}</td>
                            <td class="px-5 py-3 text-gray-600 dark:text-gray-300">{{ $b->user?->name ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold
                                    {{ match($b->status_color) { 'emerald' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400', 'blue' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400', 'red' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400', default => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' } }}">
                                    {{ $b->status }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-right font-semibold text-gray-700 dark:text-gray-200">Rp {{ number_format($b->total_price) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-5 py-8 text-center text-gray-400">No bookings yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Popular Routes --}}
        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 dark:text-white mb-4">Popular Routes</h3>
            <div class="space-y-3">
                @forelse($popularRoutes as $i => $route)
                <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-white/5">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center text-white text-xs font-bold shadow-sm">
                        {{ $i + 1 }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-200 truncate">{{ $route->origin_station }} → {{ $route->destination_station }}</p>
                        <p class="text-xs text-gray-400">{{ $route->total_bookings }} bookings</p>
                    </div>
                    <p class="text-xs font-semibold text-emerald-500">Rp {{ number_format($route->total_revenue) }}</p>
                </div>
                @empty
                <p class="text-gray-400 text-sm text-center py-4">No data</p>
                @endforelse
            </div>
        </div>
    </div>

</x-layouts.app>
