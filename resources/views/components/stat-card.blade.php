@props(['label', 'value', 'color' => 'gray', 'icon' => 'users'])

@php
// Professional monochrome color scheme
$bgColors = [
    'gray' => 'bg-slate-100 text-slate-700 dark:bg-slate-800/50 dark:text-slate-300',
];

$icons = [
    'users' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
    'revenue' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    'train' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
    'station' => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
];

// More aggressive font size scaling for single line display
$valueLength = strlen(strip_tags($value));
if ($valueLength > 18) {
    $fontSize = 'text-base'; // 16px
} elseif ($valueLength > 14) {
    $fontSize = 'text-lg'; // 18px
} elseif ($valueLength > 10) {
    $fontSize = 'text-xl'; // 20px
} elseif ($valueLength > 6) {
    $fontSize = 'text-2xl'; // 24px
} else {
    $fontSize = 'text-3xl'; // 30px
}
@endphp

<div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 p-6 shadow-sm hover:shadow-md transition-shadow overflow-hidden">
    <div class="flex items-center gap-3 mb-4">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 {{ $bgColors['gray'] }}">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">{!! $icons[$icon] ?? $icons['users'] !!}</svg>
        </div>
        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider leading-tight">{{ $label }}</p>
    </div>
    <p class="stat-value {{ $fontSize }} font-bold text-slate-900 dark:text-white whitespace-nowrap">{!! $value !!}</p>
</div>
