<x-layouts.app :title="'Passenger Insights'">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Passenger Insights</h1>
        <p class="text-sm text-gray-500 mt-1">Passenger statistics per route and per train class</p>
    </div>

    {{-- Class Summary --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        @foreach($classSummary as $cs)
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm p-6 flex flex-col justify-center">
            <div class="flex items-center justify-between mb-4">
                <span class="px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider {{ match($cs->coach_class) { 'First Class'=>'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400','Bisnis'=>'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',default=>'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400'} }}">
                    {{ $cs->coach_class }}
                </span>
            </div>
            <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ number_format($cs->total_passengers) }}</p>
            <p class="text-sm font-semibold text-gray-500 mt-1 uppercase tracking-wider">Passengers</p>
            <p class="text-sm font-bold text-emerald-600 mt-4 pt-4 border-t border-gray-100 dark:border-white/10">Rp {{ number_format($cs->total_revenue) }} Total Revenue</p>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
        {{-- Chart --}}
        <div class="xl:col-span-1 bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm p-6">
            <h3 class="font-bold text-slate-900 dark:text-white tracking-tight mb-4">Passengers by Class</h3>
            <div id="passengerClassChart" class="h-[300px]"></div>
        </div>

        {{-- Route Stats Table --}}
        <div class="xl:col-span-2 bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden flex flex-col">
            <div class="p-6 border-b border-gray-100 dark:border-white/10">
                <h3 class="font-bold text-slate-900 dark:text-white tracking-tight">Passengers per Route & Class</h3>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-sm text-left min-w-[700px]">
                    <thead class="bg-gray-50 dark:bg-white/5 text-slate-600 dark:text-gray-400 text-xs uppercase font-bold tracking-wider border-b border-gray-200 dark:border-white/10">
                        <tr>
                            <th class="px-6 py-4 whitespace-nowrap">Route</th>
                            <th class="px-6 py-4 whitespace-nowrap">Class</th>
                            <th class="px-6 py-4 text-center whitespace-nowrap">Passengers</th>
                            <th class="px-6 py-4 text-center whitespace-nowrap">Bookings</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($routeStats as $rs)
                        <tr class="hover:bg-gray-50/80 dark:hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-gray-200 whitespace-nowrap">{{ $rs->origin_station }} <span class="text-gray-400 mx-1">→</span> {{ $rs->destination_station }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider {{ match($rs->coach_class) { 'First Class'=>'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400','Bisnis'=>'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',default=>'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400'} }}">{{ $rs->coach_class }}</span>
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-slate-900 dark:text-white whitespace-nowrap">{{ number_format($rs->total_passengers) }}</td>
                            <td class="px-6 py-4 text-center font-medium text-gray-500 whitespace-nowrap">{{ number_format($rs->total_bookings) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="px-6 py-12 text-center text-gray-400">No passenger data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
