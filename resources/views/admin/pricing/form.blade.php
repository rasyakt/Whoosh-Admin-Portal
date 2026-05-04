<x-layouts.app :title="isset($pricing) ? 'Edit Pricing' : 'Add Pricing Rule'">

    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.pricing.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                Back to Pricing
            </a>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white mt-2 tracking-tight">{{ isset($pricing) ? 'Edit Pricing Rule' : 'Add New Pricing Rule' }}</h1>
        </div>

        <div class="bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 rounded-xl shadow-sm p-6 md:p-8">
            <form method="POST" action="{{ isset($pricing) ? route('admin.pricing.update', $pricing) : route('admin.pricing.store') }}" class="space-y-6">
                @csrf
                @if(isset($pricing)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Origin Station <span class="text-red-500">*</span></label>
                        <select name="origin_station" required class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
                            @foreach($stations as $st)
                                <option value="{{ $st->name }}" {{ old('origin_station', $pricing->origin_station ?? '') === $st->name ? 'selected' : '' }}>{{ $st->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Destination Station <span class="text-red-500">*</span></label>
                        <select name="destination_station" required class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
                            @foreach($stations as $st)
                                <option value="{{ $st->name }}" {{ old('destination_station', $pricing->destination_station ?? '') === $st->name ? 'selected' : '' }}>{{ $st->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Coach Class <span class="text-red-500">*</span></label>
                    <select name="coach_class" required class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
                        @foreach(['Ekonomi', 'Bisnis', 'First Class'] as $c)
                            <option value="{{ $c }}" {{ old('coach_class', $pricing->coach_class ?? '') === $c ? 'selected' : '' }}>{{ $c }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Base Price (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="base_price" value="{{ old('base_price', $pricing->base_price ?? 0) }}" required min="0"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Peak Price (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="peak_price" value="{{ old('peak_price', $pricing->peak_price ?? 0) }}" required min="0"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Off-Peak (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="off_peak_price" value="{{ old('off_peak_price', $pricing->off_peak_price ?? 0) }}" required min="0"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Effective From</label>
                        <input type="date" name="effective_from" value="{{ old('effective_from', $pricing->effective_from ?? '') }}"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Effective Until</label>
                        <input type="date" name="effective_until" value="{{ old('effective_until', $pricing->effective_until ?? '') }}"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-white/10">
                    <button type="submit" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-sm transition-colors text-sm">
                        {{ isset($pricing) ? 'Update Pricing' : 'Create Pricing Rule' }}
                    </button>
                    <a href="{{ route('admin.pricing.index') }}" class="px-6 py-2.5 bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-200 dark:hover:bg-white/10 transition-colors text-sm">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app>
