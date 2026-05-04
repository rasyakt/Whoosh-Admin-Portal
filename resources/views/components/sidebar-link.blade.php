@props(['href', 'active' => false, 'icon' => 'home'])

@php
$icons = [
    'home' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />',
    'station' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />',
    'train' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 13h18M5 17h14m-12-8h10M7 5h6a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2zM9 17v2m6-2v2" />',
    'schedule' => '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />',
    'pricing' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
    'ticket' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v3.375c0 .621.504 1.125 1.125 1.125h3.375M11.25 12h2.25M11.25 15h2.25m-2.812-9H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V11.25a2.25 2.25 0 00-2.25-2.25h-6.375c-.621 0-1.125-.504-1.125-1.125V3.375c0-.621-.504-1.125-1.125-1.125H8.25" />',
    'users' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />',
    'report' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />',
];
$svgPath = $icons[$icon] ?? $icons['home'];
@endphp

<a href="{{ $href }}"
   class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-all duration-200 group/link
          {{ $active
              ? 'bg-gray-100 dark:bg-white/5 text-slate-900 dark:text-white'
              : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-white/5 hover:text-slate-900 dark:hover:text-white' }}">
    
    <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors
                {{ $active 
                    ? 'bg-red-600 text-white shadow-sm' 
                    : 'bg-gray-50 dark:bg-white/5 text-gray-400 dark:text-gray-500 group-hover/link:bg-gray-100 dark:group-hover/link:bg-white/10' }}">
        <svg class="w-4.5 h-4.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">{!! $svgPath !!}</svg>
    </div>

    <span class="flex-1">{{ $slot }}</span>
    
    @if($active)
        <div class="w-1 h-4 rounded-full bg-red-600"></div>
    @endif
</a>
