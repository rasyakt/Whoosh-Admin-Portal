@php $user = (object) session('admin_user'); @endphp

<header class="sticky top-0 z-30 bg-white/80 dark:bg-[#1a1a2e]/80 backdrop-blur-xl border-b border-gray-200/50 dark:border-white/5">
    <div class="flex items-center justify-between h-16 px-4 md:px-6 lg:px-8">
        {{-- Left: Mobile menu + Breadcrumb --}}
        <div class="flex items-center gap-3">
            <button id="sidebarToggle" class="lg:hidden p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-white/10 transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div>
                <h2 class="text-lg font-bold text-gray-800 dark:text-white">{{ $title ?? 'Dashboard' }}</h2>
                <p class="text-xs text-gray-400 hidden sm:block">Welcome back, {{ $user->name }}</p>
            </div>
        </div>

        {{-- Right: Actions --}}
        <div class="flex items-center gap-2">
            {{-- Dark Mode Toggle --}}
            <button id="darkModeToggle" class="p-2.5 rounded-xl bg-gray-100 dark:bg-white/10 hover:bg-gray-200 dark:hover:bg-white/20 transition-all duration-200">
                <svg class="w-5 h-5 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                <svg class="w-5 h-5 hidden dark:block text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/></svg>
            </button>

            {{-- Current Time --}}
            <div class="hidden md:flex items-center gap-2 px-3 py-2 rounded-xl bg-gray-100 dark:bg-white/10 text-sm font-medium text-gray-600 dark:text-gray-300">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                <span id="currentTime"></span>
            </div>
        </div>
    </div>
</header>

<script>
function updateTime() {
    const el = document.getElementById('currentTime');
    if (el) {
        const now = new Date();
        el.textContent = now.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' }) + ' · ' + now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
    }
}
updateTime();
setInterval(updateTime, 30000);
</script>
