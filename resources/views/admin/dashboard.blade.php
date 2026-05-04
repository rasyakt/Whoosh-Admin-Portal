<x-layouts.app :title="'Admin Dashboard'">

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <x-stat-card label="Total Users" :value="$stats['total_users']" color="blue" icon="users" />
        <x-stat-card label="Total Revenue" :value="'Rp&nbsp;' . number_format($stats['total_revenue'])" color="emerald" icon="revenue" />
        <x-stat-card label="Active Trains" :value="$stats['active_trains']" color="amber" icon="train" />
        <x-stat-card label="Total Stations" :value="$stats['total_stations']" color="violet" icon="station" />
    </div>

    {{-- Ticket Status Row --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="p-6 rounded-xl bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 shadow-sm flex flex-col justify-center">
            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Pending</p>
            <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $stats['pending_tickets'] }}</p>
        </div>
        <div class="p-6 rounded-xl bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 shadow-sm flex flex-col justify-center">
            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Paid</p>
            <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $stats['paid_tickets'] }}</p>
        </div>
        <div class="p-6 rounded-xl bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 shadow-sm flex flex-col justify-center">
            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Completed</p>
            <p class="text-3xl font-bold text-emerald-600">{{ $stats['completed_tickets'] }}</p>
        </div>
        <div class="p-6 rounded-xl bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 shadow-sm flex flex-col justify-center">
            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Cancelled</p>
            <p class="text-3xl font-bold text-red-600">{{ $stats['cancelled_tickets'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        {{-- Recent Bookings --}}
        <div class="xl:col-span-2 bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 dark:border-white/10 flex items-center justify-between">
                <h3 class="font-bold text-slate-900 dark:text-white tracking-tight">Recent Bookings</h3>
                <a href="{{ route('admin.tickets.index') }}" class="text-sm text-red-600 hover:text-red-700 font-semibold transition-colors">View All →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left min-w-[800px]">
                    <thead class="bg-gray-50 dark:bg-white/5 text-slate-600 dark:text-gray-400 text-xs uppercase font-bold tracking-wider border-b border-gray-200 dark:border-white/10">
                        <tr>
                            <th class="px-6 py-4 whitespace-nowrap">Code</th>
                            <th class="px-6 py-4 whitespace-nowrap">Route</th>
                            <th class="px-6 py-4 whitespace-nowrap">User</th>
                            <th class="px-6 py-4 whitespace-nowrap">Status</th>
                            <th class="px-6 py-4 text-right whitespace-nowrap">Price</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($recentBookings as $b)
                        <tr class="hover:bg-gray-50/80 dark:hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4 font-mono font-bold text-xs text-slate-700 dark:text-gray-300 whitespace-nowrap">{{ $b->booking_code }}</td>
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200 whitespace-nowrap">{{ $b->origin_station }} <span class="text-gray-400 mx-1">→</span> {{ $b->destination_station }}</td>
                            <td class="px-6 py-4 text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $b->user?->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider
                                    {{ match($b->status_color) { 'emerald' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400', 'blue' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400', 'red' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400', default => 'bg-gray-100 text-gray-700 dark:bg-white/10 dark:text-gray-400' } }}">
                                    {{ $b->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-white whitespace-nowrap">Rp {{ number_format($b->total_price) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-6 py-10 text-center text-gray-400">No bookings yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Popular Routes --}}
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm flex flex-col">
            <div class="p-5 border-b border-gray-100 dark:border-white/10">
                <h3 class="font-bold text-slate-900 dark:text-white tracking-tight">Popular Routes</h3>
            </div>
            <div class="p-5 space-y-4 flex-1">
                @forelse($popularRoutes as $i => $route)
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-white/5 flex items-center justify-center text-slate-700 dark:text-gray-300 text-xs font-bold">
                        {{ $i + 1 }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white truncate">{{ $route->origin_station }} <span class="text-gray-400 mx-0.5">→</span> {{ $route->destination_station }}</p>
                        <p class="text-xs font-medium text-gray-500">{{ $route->total_bookings }} bookings</p>
                    </div>
                    <p class="text-sm font-bold text-emerald-600">Rp {{ number_format($route->total_revenue) }}</p>
                </div>
                @empty
                <div class="flex items-center justify-center h-full">
                    <p class="text-gray-400 text-sm text-center">No data available</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

</x-layouts.app>
