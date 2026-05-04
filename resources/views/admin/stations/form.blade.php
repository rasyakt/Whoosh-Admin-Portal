<x-layouts.app :title="isset($station) ? 'Edit Station' : 'Add Station'">

    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.stations.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                Back to Stations
            </a>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white mt-2 tracking-tight">{{ isset($station) ? 'Edit Station' : 'Add New Station' }}</h1>
        </div>

        <div class="bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 rounded-xl shadow-sm p-6 md:p-8">
            <form method="POST" action="{{ isset($station) ? route('admin.stations.update', $station) : route('admin.stations.store') }}" class="space-y-6">
                @csrf
                @if(isset($station)) @method('PUT') @endif

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Station Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $station->name ?? '') }}" required
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-slate-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-sm"
                        placeholder="e.g. Tegalluar">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Station Code <span class="text-red-500">*</span></label>
                    <input type="text" name="code" value="{{ old('code', $station->code ?? '') }}" required maxlength="10"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-slate-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-sm font-mono uppercase"
                        placeholder="e.g. TGL">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Location</label>
                    <input type="text" name="location" value="{{ old('location', $station->location ?? '') }}"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-slate-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-sm"
                        placeholder="e.g. Bandung, Jawa Barat">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Facilities</label>
                    <textarea name="facilities" rows="3"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-slate-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-sm resize-none"
                        placeholder="e.g. WiFi, Parking, Waiting Lounge, Prayer Room">{{ old('facilities', $station->facilities ?? '') }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-white/10">
                    <button type="submit" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-sm transition-colors text-sm">
                        {{ isset($station) ? 'Update Station' : 'Create Station' }}
                    </button>
                    <a href="{{ route('admin.stations.index') }}" class="px-6 py-2.5 bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-200 dark:hover:bg-white/10 transition-colors text-sm">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app>
