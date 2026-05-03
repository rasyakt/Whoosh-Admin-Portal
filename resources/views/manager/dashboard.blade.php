<x-layouts.app :title="'Manager Dashboard'">

    {{-- Revenue Widgets --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
        <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-5 shadow-lg shadow-emerald-500/20">
            <div class="relative z-10">
                <p class="text-emerald-100 text-sm font-medium">Today's Revenue</p>
                <p class="text-2xl font-bold text-white mt-1">Rp {{ number_format($todayRevenue) }}</p>
            </div>
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
        </div>
        <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-5 shadow-lg shadow-blue-500/20">
            <div class="relative z-10">
                <p class="text-blue-100 text-sm font-medium">Weekly Revenue</p>
                <p class="text-2xl font-bold text-white mt-1">Rp {{ number_format($weeklyRevenue) }}</p>
            </div>
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
        </div>
        <div class="relative overflow-hidden bg-gradient-to-br from-violet-500 to-purple-600 rounded-2xl p-5 shadow-lg shadow-violet-500/20">
            <div class="relative z-10">
                <p class="text-violet-100 text-sm font-medium">Monthly Revenue</p>
                <p class="text-2xl font-bold text-white mt-1">Rp {{ number_format($monthlyRevenue) }}</p>
            </div>
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
        </div>
        <div class="relative overflow-hidden bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-5 shadow-lg shadow-red-500/20">
            <div class="relative z-10">
                <p class="text-red-100 text-sm font-medium">Total Revenue</p>
                <p class="text-2xl font-bold text-white mt-1">Rp {{ number_format($totalRevenue) }}</p>
            </div>
            <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <x-stat-card label="Total Bookings" :value="$totalBookings" color="blue" icon="revenue" />
        <x-stat-card label="Registered Users" :value="$totalUsers" color="violet" icon="users" />
        <x-stat-card label="Active Paid Tickets" :value="$activePaidTickets" color="emerald" icon="revenue" />
    </div>

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
        {{-- Sales Trend --}}
        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 dark:text-white mb-4">Sales Trend (Last 30 Days)</h3>
            <div id="salesTrendChart" class="h-[300px]"></div>
        </div>

        {{-- Popular Routes --}}
        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 dark:text-white mb-4">Popular Routes</h3>
            <div id="popularRoutesChart" class="h-[300px]"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
        {{-- Class Distribution --}}
        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 dark:text-white mb-4">Class Distribution</h3>
            <div id="classDistChart" class="h-[300px]"></div>
        </div>

        {{-- Monthly Revenue Trend --}}
        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 dark:text-white mb-4">Monthly Revenue Trend</h3>
            <div id="monthlyTrendChart" class="h-[300px]"></div>
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('manager.reports.sales') }}" class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-5 hover:shadow-md transition-shadow group">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800 dark:text-white group-hover:text-red-500 transition-colors">Sales Report</h4>
                    <p class="text-sm text-gray-500">View detailed sales data with date filters</p>
                </div>
            </div>
        </a>
        <a href="{{ route('manager.reports.passengers') }}" class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-5 hover:shadow-md transition-shadow group">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center shadow-lg shadow-violet-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800 dark:text-white group-hover:text-red-500 transition-colors">Passenger Insights</h4>
                    <p class="text-sm text-gray-500">Passenger statistics by route and class</p>
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
            colors: ['#e63946', '#3b82f6'],
            fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.05 } },
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
            colors: ['#e63946'],
            plotOptions: { bar: { borderRadius: 8, columnWidth: '60%' } },
            fill: { type: 'gradient', gradient: { shade: 'dark', type: 'vertical', shadeIntensity: 0.3, gradientToColors: ['#f77f00'], stops: [0, 100] } },
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
            colors: ['#8b5cf6'],
            plotOptions: { bar: { borderRadius: 8, columnWidth: '55%' } },
            fill: { type: 'gradient', gradient: { shade: 'dark', type: 'vertical', shadeIntensity: 0.2, gradientToColors: ['#a78bfa'], stops: [0, 100] } },
            grid: { borderColor: gridColor },
            tooltip: { theme: isDark ? 'dark' : 'light' }
        }).render();
    }
});
</script>
@endpush

</x-layouts.app>
