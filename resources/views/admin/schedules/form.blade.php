<x-layouts.app :title="isset($schedule) ? 'Edit Schedule' : 'Add Schedule'">

    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.schedules.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-red-500 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 19l-7-7 7-7"/></svg>
                Back to Schedules
            </a>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mt-2">{{ isset($schedule) ? 'Edit Schedule' : 'Add New Schedule' }}</h1>
        </div>

        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-6 md:p-8">
            <form method="POST" action="{{ isset($schedule) ? route('admin.schedules.update', $schedule) : route('admin.schedules.store') }}" class="space-y-5">
                @csrf
                @if(isset($schedule)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Train</label>
                        <select name="train_id" class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-gray-700 dark:text-gray-200">
                            <option value="">— Select Train —</option>
                            @foreach($trains as $t)
                                <option value="{{ $t->id }}" {{ old('train_id', $schedule->train_id ?? '') == $t->id ? 'selected' : '' }}>{{ $t->name }} ({{ $t->train_code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Train Code <span class="text-red-500">*</span></label>
                        <input type="text" name="train_code" value="{{ old('train_code', $schedule->train_code ?? '') }}" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm font-mono focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-gray-700 dark:text-gray-200" placeholder="e.g. G1101">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Origin Station <span class="text-red-500">*</span></label>
                        <select name="origin_station_id" required class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-gray-700 dark:text-gray-200">
                            <option value="">— Select —</option>
                            @foreach($stations as $st)
                                <option value="{{ $st->id }}" {{ old('origin_station_id', $schedule->origin_station_id ?? '') == $st->id ? 'selected' : '' }}>{{ $st->name }} ({{ $st->code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Destination Station <span class="text-red-500">*</span></label>
                        <select name="destination_station_id" required class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-gray-700 dark:text-gray-200">
                            <option value="">— Select —</option>
                            @foreach($stations as $st)
                                <option value="{{ $st->id }}" {{ old('destination_station_id', $schedule->destination_station_id ?? '') == $st->id ? 'selected' : '' }}>{{ $st->name }} ({{ $st->code }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Departure Time <span class="text-red-500">*</span></label>
                        <input type="time" name="departure_time" value="{{ old('departure_time', $schedule->departure_time ?? '') }}" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-gray-700 dark:text-gray-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                        <label class="flex items-center gap-3 mt-1 cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $schedule->is_active ?? 1) ? 'checked' : '' }}
                                class="w-5 h-5 rounded-md border-gray-300 text-red-500 focus:ring-red-500/30">
                            <span class="text-sm text-gray-600 dark:text-gray-300">Active Schedule</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl shadow-lg shadow-red-500/25 transition-all text-sm">
                        {{ isset($schedule) ? 'Update Schedule' : 'Create Schedule' }}
                    </button>
                    <a href="{{ route('admin.schedules.index') }}" class="px-6 py-3 bg-gray-100 dark:bg-white/10 text-gray-600 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-200 dark:hover:bg-white/20 transition-colors text-sm">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app>
