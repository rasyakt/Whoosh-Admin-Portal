@props(['label', 'value', 'color' => 'blue', 'icon' => 'users'])

@php
$gradients = [
    'blue' => 'from-blue-500 to-blue-600',
    'emerald' => 'from-emerald-500 to-emerald-600',
    'amber' => 'from-amber-500 to-orange-500',
    'violet' => 'from-violet-500 to-purple-600',
    'red' => 'from-red-500 to-red-600',
];

$shadows = [
    'blue' => 'shadow-blue-500/20',
    'emerald' => 'shadow-emerald-500/20',
    'amber' => 'shadow-amber-500/20',
    'violet' => 'shadow-violet-500/20',
    'red' => 'shadow-red-500/20',
];

$icons = [
    'users' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
    'revenue' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    'train' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
    'station' => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
];
@endphp

<div class="relative overflow-hidden bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 p-5 shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $label }}</p>
            <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $value }}</p>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br {{ $gradients[$color] }} flex items-center justify-center shadow-lg {{ $shadows[$color] }}">
            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">{!! $icons[$icon] ?? $icons['users'] !!}</svg>
        </div>
    </div>
    {{-- Decorative gradient --}}
    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-gradient-to-br {{ $gradients[$color] }} opacity-5 rounded-full"></div>
</div>
