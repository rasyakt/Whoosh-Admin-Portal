@props(['editRoute' => null, 'deleteRoute' => null, 'viewRoute' => null, 'deleteConfirm' => 'Are you sure you want to delete this item?'])

<div class="relative inline-block text-left" x-data="{ open: false, dropup: false }" @click.away="open = false">
    <!-- Trigger Button -->
    <button @click="open = !open; 
                    $nextTick(() => {
                        if (open) {
                            const button = $el.getBoundingClientRect();
                            const dropdown = $el.nextElementSibling;
                            
                            // Wait for dropdown to render, then calculate
                            setTimeout(() => {
                                const dropdownHeight = dropdown.offsetHeight || 200; // fallback to 200px
                                const spaceBelow = window.innerHeight - button.bottom;
                                const spaceAbove = button.top;
                                
                                // Add 20px buffer for safety
                                dropup = (spaceBelow - 20) < dropdownHeight && (spaceAbove - 20) > dropdownHeight;
                            }, 10);
                        }
                    })" 
            type="button" 
            class="p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-white/10 transition-colors">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
        </svg>
    </button>

    <!-- Dropdown Menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         @click="open = false"
         :class="dropup ? 'bottom-full mb-2' : 'top-full mt-2'"
         class="absolute right-0 z-[9999] w-48 origin-top-right rounded-lg bg-white dark:bg-[#1a1a2e] shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none border border-gray-200 dark:border-white/10"
         style="display: none;">
        <div class="py-1">
            @if($viewRoute)
            <a href="{{ $viewRoute }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                View Details
            </a>
            @endif

            @if($editRoute)
            <a href="{{ $editRoute }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>
            @endif

            @if($deleteRoute)
            <form method="POST" action="{{ $deleteRoute }}" onsubmit="return confirm('{{ $deleteConfirm }}')">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete
                </button>
            </form>
            @endif

            {{ $slot }}
        </div>
    </div>
</div>
