<x-layouts.app :title="'Passenger Insights'">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Passenger Insights</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Passenger statistics per route and per train class</p>
    </div>

    {{-- Class Summary --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        @foreach($classSummary as $cs)
        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <span class="px-3 py-1.5 rounded-xl text-xs font-bold {{ match($cs->coach_class) { 'First Class'=>'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400','Bisnis'=>'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',default=>'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400'} }}">{{ $cs->coach_class }}</span>
            </div>
            <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ number_format($cs->total_passengers) }}</p>
            <p class="text-sm text-gray-500 mt-1">passengers</p>
            <p class="text-sm font-semibold text-emerald-500 mt-2">Rp {{ number_format($cs->total_revenue) }}</p>
        </div>
        @endforeach
    </div>

    {{-- Chart --}}
    <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-5 mb-8">
        <h3 class="font-bold text-gray-800 dark:text-white mb-4">Passengers by Class</h3>
        <div id="passengerClassChart" class="h-[300px]"></div>
    </div>

    {{-- Route Stats Table --}}
    <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100 dark:border-white/5">
            <h3 class="font-bold text-gray-800 dark:text-white">Passengers per Route & Class</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50/80 dark:bg-white/5">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Route</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Class</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Passengers</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Bookings</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($routeStats as $rs)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5">
                        <td class="px-6 py-3 font-medium text-gray-700 dark:text-gray-200">{{ $rs->origin_station }} → {{ $rs->destination_station }}</td>
                        <td class="px-6 py-3">
                            <span class="px-2.5 py-1 rounded-lg text-xs font-semibold {{ match($rs->coach_class) { 'First Class'=>'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400','Bisnis'=>'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',default=>'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400'} }}">{{ $rs->coach_class }}</span>
                        </td>
                        <td class="px-6 py-3 text-center font-bold text-gray-700 dark:text-gray-200">{{ number_format($rs->total_passengers) }}</td>
                        <td class="px-6 py-3 text-center text-gray-500">{{ number_format($rs->total_bookings) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-12 text-center text-gray-400">No passenger data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const isDark = document.documentElement.classList.contains('dark');
    const textColor = isDark ? '#94a3b8' : '#64748b';
    const classData = @json($classSummary);
    if (classData.length > 0) {
        new ApexCharts(document.querySelector("#passengerClassChart"), {
            chart: { type: 'donut', height: 300, fontFamily: 'Inter' },
            series: classData.map(c => c.total_passengers),
            labels: classData.map(c => c.coach_class),
            colors: ['#10b981', '#3b82f6', '#f59e0b'],
            legend: { position: 'bottom', labels: { colors: textColor } },
            plotOptions: { pie: { donut: { size: '65%', labels: { show: true, total: { show: true, label: 'Total Pax', color: textColor } } } } },
            tooltip: { theme: isDark ? 'dark' : 'light' }
        }).render();
    }
});
</script>
@endpush
</x-layouts.app>
