<x-layouts.app :title="isset($schedule) ? 'Edit Schedule' : 'Add Schedule'">

    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.schedules.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                Back to Schedules
            </a>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white mt-2 tracking-tight">{{ isset($schedule) ? 'Edit Schedule' : 'Add New Schedule' }}</h1>
        </div>

        <div class="bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 rounded-xl shadow-sm p-6 md:p-8">
            <form method="POST" action="{{ isset($schedule) ? route('admin.schedules.update', $schedule) : route('admin.schedules.store') }}" class="space-y-6">
                @csrf
                @if(isset($schedule)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Train</label>
                        <select name="train_id" class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
                            <option value="">— Select Train —</option>
                            @foreach($trains as $t)
                                <option value="{{ $t->id }}" {{ old('train_id', $schedule->train_id ?? '') == $t->id ? 'selected' : '' }}>{{ $t->name }} ({{ $t->train_code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Train Code <span class="text-red-500">*</span></label>
                        <input type="text" name="train_code" value="{{ old('train_code', $schedule->train_code ?? '') }}" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm font-mono focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white" placeholder="e.g. G1101">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Origin Station <span class="text-red-500">*</span></label>
                        <select name="origin_station_id" required class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
                            <option value="">— Select —</option>
                            @foreach($stations as $st)
                                <option value="{{ $st->id }}" {{ old('origin_station_id', $schedule->origin_station_id ?? '') == $st->id ? 'selected' : '' }}>{{ $st->name }} ({{ $st->code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Destination Station <span class="text-red-500">*</span></label>
                        <select name="destination_station_id" required class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
                            <option value="">— Select —</option>
                            @foreach($stations as $st)
                                <option value="{{ $st->id }}" {{ old('destination_station_id', $schedule->destination_station_id ?? '') == $st->id ? 'selected' : '' }}>{{ $st->name }} ({{ $st->code }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Departure Time <span class="text-red-500">*</span></label>
                        <input type="time" name="departure_time" value="{{ old('departure_time', $schedule->departure_time ?? '') }}" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Status</label>
                        <label class="flex items-center gap-3 mt-3 cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $schedule->is_active ?? 1) ? 'checked' : '' }}
                                class="w-5 h-5 rounded border-gray-300 text-red-600 focus:ring-red-600">
                            <span class="text-sm font-medium text-slate-700 dark:text-gray-300">Active Schedule</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-white/10">
                    <button type="submit" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-sm transition-colors text-sm">
                        {{ isset($schedule) ? 'Update Schedule' : 'Create Schedule' }}
                    </button>
                    <a href="{{ route('admin.schedules.index') }}" class="px-6 py-2.5 bg-gray-100 dark:bg-white/5 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-200 dark:hover:bg-white/10 transition-colors text-sm">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app>
