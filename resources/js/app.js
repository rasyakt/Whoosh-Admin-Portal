import ApexCharts from 'apexcharts';
window.ApexCharts = ApexCharts;

// Dark mode toggle
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('darkModeToggle');
    const html = document.documentElement;

    // Check stored preference
    if (localStorage.getItem('darkMode') === 'true') {
        html.classList.add('dark');
    }

    if (toggle) {
        toggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('darkMode', html.classList.contains('dark'));
        });
    }

    // Mobile sidebar toggle
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
