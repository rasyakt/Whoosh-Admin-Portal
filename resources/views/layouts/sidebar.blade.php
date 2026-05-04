@php $user = (object) session('admin_user'); @endphp

<aside id="sidebar" class="fixed top-0 left-0 z-50 w-72 h-screen bg-white dark:bg-[#1a1a2e] text-slate-800 dark:text-gray-200 flex flex-col transition-all duration-300 border-r border-gray-100 dark:border-white/5 -translate-x-full lg:translate-x-0 shadow-sm">

    {{-- Logo --}}
    <div class="p-6 border-b border-gray-100 dark:border-white/5">
        <a href="{{ $user->role === 'manager' ? route('manager.dashboard') : route('admin.dashboard') }}" class="block group">
            {{-- Logo for light mode --}}
            <img src="{{ asset('img/logo_whoosh.png') }}" alt="Whoosh Logo" class="h-16 w-auto object-contain dark:hidden">
            {{-- Logo for dark mode --}}
            <img src="{{ asset('img/logo_white.png') }}" alt="Whoosh Logo" class="h-16 w-auto object-contain hidden dark:block">
            <p class="text-[11px] text-gray-500 dark:text-gray-400 font-bold uppercase tracking-widest">Management System</p>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">

        @if($user->role === 'admin')
            <p class="px-4 pt-4 pb-2 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Overview</p>
            <x-sidebar-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')" icon="home">
                Dashboard
            </x-sidebar-link>

            <!-- <p class="px-4 pt-6 pb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Management</p> -->
            <x-sidebar-link href="{{ route('admin.stations.index') }}" :active="request()->routeIs('admin.stations.*')" icon="station">
                Stations
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('admin.trains.index') }}" :active="request()->routeIs('admin.trains.*')" icon="train">
                Trains
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('admin.schedules.index') }}" :active="request()->routeIs('admin.schedules.*')" icon="schedule">
                Schedules
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('admin.pricing.index') }}" :active="request()->routeIs('admin.pricing.*')" icon="pricing">
                Pricing
            </x-sidebar-link>

            <p class="px-4 pt-6 pb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Operations</p>
            <x-sidebar-link href="{{ route('admin.tickets.index') }}" :active="request()->routeIs('admin.tickets.*')" icon="ticket">
                Ticket Control
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')" icon="users">
                Users
            </x-sidebar-link>
        @endif

        @if($user->role === 'manager')
            <p class="px-4 pt-4 pb-2 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Analytics</p>
            <x-sidebar-link href="{{ route('manager.dashboard') }}" :active="request()->routeIs('manager.dashboard')" icon="home">
                Dashboard
            </x-sidebar-link>

            <p class="px-4 pt-6 pb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Reports</p>
            <x-sidebar-link href="{{ route('manager.reports.sales') }}" :active="request()->routeIs('manager.reports.sales')" icon="report">
                Sales Report
            </x-sidebar-link>
            <x-sidebar-link href="{{ route('manager.reports.passengers') }}" :active="request()->routeIs('manager.reports.passengers')" icon="users">
                Passenger Insights
            </x-sidebar-link>
        @endif
    </nav>

    {{-- User Card --}}
    <div class="p-4 border-t border-gray-100 dark:border-white/10">
        <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-white/5 hover:bg-gray-100 dark:hover:bg-white/10 transition-colors border border-gray-100 dark:border-transparent">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-400 to-orange-500 flex items-center justify-center text-sm font-bold text-white shadow-lg">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold truncate">{{ $user->name }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ ucfirst($user->role) }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="p-2 rounded-lg text-gray-400 hover:text-red-400 hover:bg-white/10 transition-all" title="Logout">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
        </div>
    </div>
</aside>
