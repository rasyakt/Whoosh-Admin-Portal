@props(['label', 'value', 'color' => 'blue', 'icon' => 'users'])

@php
$bgColors = [
    'blue' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
    'emerald' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
    'amber' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
    'violet' => 'bg-violet-100 text-violet-700 dark:bg-violet-900/30 dark:text-violet-400',
    'red' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
];

$icons = [
    'users' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
    'revenue' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    'train' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
    'station' => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
];

// Determine font size based on value length - more aggressive scaling for single line
$valueLength = strlen($value);
$fontSize = $valueLength > 15 ? 'text-lg' : ($valueLength > 10 ? 'text-xl' : ($valueLength > 6 ? 'text-2xl' : 'text-3xl'));
@endphp

<div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 p-6 shadow-sm">
    <div class="flex items-center gap-3 mb-3">
        <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0 {{ $bgColors[$color] ?? $bgColors['blue'] }}">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">{!! $icons[$icon] ?? $icons['users'] !!}</svg>
        </div>
        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ $label }}</p>
    </div>
    <p class="stat-value {{ $fontSize }} font-bold text-slate-900 dark:text-white whitespace-nowrap">{{ $value }}</p>
</div>
