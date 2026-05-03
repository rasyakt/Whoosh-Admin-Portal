import ApexCharts from 'apexcharts';
window.ApexCharts = ApexCharts;

// 1. Dark Mode Logic
(function() {
    const html = document.documentElement;
    const toggle = document.getElementById('darkModeToggle');

    if (toggle) {
        toggle.addEventListener('click', () => {
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('darkMode', isDark);
            console.log('Dark mode toggled:', isDark);
        });
    }
})();

// 2. Sidebar & Navigation Logic
document.addEventListener('DOMContentLoaded', () => {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay?.classList.toggle('hidden');
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', () => {
            sidebar?.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
    }
});
