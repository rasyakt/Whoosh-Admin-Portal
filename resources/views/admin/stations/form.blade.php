<x-layouts.app :title="isset($station) ? 'Edit Station' : 'Add Station'">

    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.stations.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-red-500 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 19l-7-7 7-7"/></svg>
                Back to Stations
            </a>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mt-2">{{ isset($station) ? 'Edit Station' : 'Add New Station' }}</h1>
        </div>

        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-6 md:p-8">
            <form method="POST" action="{{ isset($station) ? route('admin.stations.update', $station) : route('admin.stations.store') }}" class="space-y-5">
                @csrf
                @if(isset($station)) @method('PUT') @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Station Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $station->name ?? '') }}" required
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-gray-700 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:border-red-500/30 transition-all text-sm"
                        placeholder="e.g. Tegalluar">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Station Code <span class="text-red-500">*</span></label>
                    <input type="text" name="code" value="{{ old('code', $station->code ?? '') }}" required maxlength="10"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-gray-700 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:border-red-500/30 transition-all text-sm font-mono uppercase"
                        placeholder="e.g. TGL">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Location</label>
                    <input type="text" name="location" value="{{ old('location', $station->location ?? '') }}"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-gray-700 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:border-red-500/30 transition-all text-sm"
                        placeholder="e.g. Bandung, Jawa Barat">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Facilities</label>
                    <textarea name="facilities" rows="3"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-gray-700 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:border-red-500/30 transition-all text-sm resize-none"
                        placeholder="e.g. WiFi, Parking, Waiting Lounge, Prayer Room">{{ old('facilities', $station->facilities ?? '') }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl shadow-lg shadow-red-500/25 transition-all duration-200 text-sm">
                        {{ isset($station) ? 'Update Station' : 'Create Station' }}
                    </button>
                    <a href="{{ route('admin.stations.index') }}" class="px-6 py-3 bg-gray-100 dark:bg-white/10 text-gray-600 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-200 dark:hover:bg-white/20 transition-colors text-sm">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app>
