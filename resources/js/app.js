import ApexCharts from 'apexcharts';
window.ApexCharts = ApexCharts;

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// 1. Dark Mode Logic - Load and persist preference
(function() {
    const html = document.documentElement;
    
    // Load dark mode preference on page load
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    if (isDarkMode) {
        html.classList.add('dark');
    } else {
        html.classList.remove('dark');
    }

    // Toggle dark mode on button click
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
