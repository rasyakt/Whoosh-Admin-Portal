<x-layouts.app :title="'Manager Dashboard'">

    {{-- Revenue Widgets --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 p-6 shadow-sm flex flex-col justify-center">
            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Today's Revenue</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white whitespace-nowrap">Rp&nbsp;{{ number_format($todayRevenue) }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 p-6 shadow-sm flex flex-col justify-center">
            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Weekly Revenue</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white whitespace-nowrap">Rp&nbsp;{{ number_format($weeklyRevenue) }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 p-6 shadow-sm flex flex-col justify-center">
            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Monthly Revenue</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white whitespace-nowrap">Rp&nbsp;{{ number_format($monthlyRevenue) }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 p-6 shadow-sm flex flex-col justify-center">
            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider">Total Revenue</p>
            <p class="text-2xl font-bold text-emerald-600 whitespace-nowrap">Rp&nbsp;{{ number_format($totalRevenue) }}</p>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <x-stat-card label="Total Bookings" :value="$totalBookings" color="blue" icon="revenue" />
        <x-stat-card label="Registered Users" :value="$totalUsers" color="violet" icon="users" />
        <x-stat-card label="Active Paid Tickets" :value="$activePaidTickets" color="emerald" icon="revenue" />
    </div>

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
        {{-- Sales Trend --}}
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm p-6">
            <h3 class="font-bold text-slate-900 dark:text-white tracking-tight mb-4">Sales Trend (Last 30 Days)</h3>
            <div id="salesTrendChart" class="h-[300px]"></div>
        </div>

        {{-- Popular Routes --}}
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm p-6">
            <h3 class="font-bold text-slate-900 dark:text-white tracking-tight mb-4">Popular Routes</h3>
            <div id="popularRoutesChart" class="h-[300px]"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
        {{-- Class Distribution --}}
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm p-6">
            <h3 class="font-bold text-slate-900 dark:text-white tracking-tight mb-4">Class Distribution</h3>
            <div id="classDistChart" class="h-[300px]"></div>
        </div>

        {{-- Monthly Revenue Trend --}}
        <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm p-6">
            <h3 class="font-bold text-slate-900 dark:text-white tracking-tight mb-4">Monthly Revenue Trend</h3>
            <div id="monthlyTrendChart" class="h-[300px]"></div>
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('manager.reports.sales') }}" class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm p-6 hover:border-red-500 dark:hover:border-red-500 transition-colors group">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white group-hover:text-red-600 transition-colors">Sales Report</h4>
                    <p class="text-sm font-medium text-gray-500 mt-0.5">View detailed sales data with date filters</p>
                </div>
            </div>
        </a>
        <a href="{{ route('manager.reports.passengers') }}" class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm p-6 hover:border-red-500 dark:hover:border-red-500 transition-colors group">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white group-hover:text-red-600 transition-colors">Passenger Insights</h4>
                    <p class="text-sm font-medium text-gray-500 mt-0.5">Passenger statistics by route and class</p>
                </div>
            </div>
        </a>
    </div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const isDark = document.documentElement.classList.contains('dark');
    const textColor = isDark ? '#94a3b8' : '#64748b';
    const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

    // Sales Trend
    const salesData = @json($salesByDay);
    if (salesData.length > 0) {
        new ApexCharts(document.querySelector("#salesTrendChart"), {
            chart: { type: 'area', height: 300, toolbar: { show: false }, fontFamily: 'Inter' },
            series: [
                { name: 'Revenue', data: salesData.map(d => d.total_revenue) },
                { name: 'Tickets', data: salesData.map(d => d.total_tickets) }
            ],
            xaxis: { categories: salesData.map(d => d.date), labels: { style: { colors: textColor, fontSize: '11px' }, rotate: -45 } },
            yaxis: [
                { labels: { style: { colors: textColor }, formatter: v => 'Rp ' + (v/1000000).toFixed(1) + 'M' } },
                { opposite: true, labels: { style: { colors: textColor } } }
            ],
            colors: ['#dc2626', '#2563eb'],
            fill: { type: 'solid', opacity: [0.1, 0.1] },
            stroke: { curve: 'smooth', width: 2 },
            grid: { borderColor: gridColor },
            tooltip: { theme: isDark ? 'dark' : 'light' },
            legend: { labels: { colors: textColor } }
        }).render();
    }

    // Popular Routes
    const routeData = @json($popularRoutes);
    if (routeData.length > 0) {
        new ApexCharts(document.querySelector("#popularRoutesChart"), {
            chart: { type: 'bar', height: 300, toolbar: { show: false }, fontFamily: 'Inter' },
            series: [{ name: 'Bookings', data: routeData.map(r => r.total_bookings) }],
            xaxis: { categories: routeData.map(r => r.origin_station + ' → ' + r.destination_station), labels: { style: { colors: textColor, fontSize: '10px' } } },
            yaxis: { labels: { style: { colors: textColor } } },
            colors: ['#dc2626'],
            plotOptions: { bar: { borderRadius: 4, columnWidth: '60%' } },
            fill: { type: 'solid', opacity: 1 },
            grid: { borderColor: gridColor },
            tooltip: { theme: isDark ? 'dark' : 'light' }
        }).render();
    }

    // Class Distribution
    const classData = @json($classDistribution);
    if (classData.length > 0) {
        new ApexCharts(document.querySelector("#classDistChart"), {
            chart: { type: 'donut', height: 300, fontFamily: 'Inter' },
            series: classData.map(c => c.total),
            labels: classData.map(c => c.coach_class),
            colors: ['#10b981', '#3b82f6', '#f59e0b'],
            legend: { position: 'bottom', labels: { colors: textColor } },
            plotOptions: { pie: { donut: { size: '65%', labels: { show: true, total: { show: true, label: 'Total', color: textColor } } } } },
            tooltip: { theme: isDark ? 'dark' : 'light' }
        }).render();
    }

    // Monthly Trend
    const monthData = @json($monthlyTrend);
    if (monthData.length > 0) {
        new ApexCharts(document.querySelector("#monthlyTrendChart"), {
            chart: { type: 'bar', height: 300, toolbar: { show: false }, fontFamily: 'Inter' },
            series: [{ name: 'Revenue', data: monthData.map(m => m.total_revenue) }],
            xaxis: { categories: monthData.map(m => m.month), labels: { style: { colors: textColor, fontSize: '11px' } } },
            yaxis: { labels: { style: { colors: textColor }, formatter: v => 'Rp ' + (v/1000000).toFixed(1) + 'M' } },
            colors: ['#059669'],
            plotOptions: { bar: { borderRadius: 4, columnWidth: '55%' } },
            fill: { type: 'solid', opacity: 1 },
            grid: { borderColor: gridColor },
            tooltip: { theme: isDark ? 'dark' : 'light' }
        }).render();
    }
});
</script>
@endpush

</x-layouts.app>
