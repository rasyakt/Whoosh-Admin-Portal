<x-layouts.app :title="isset($train) ? 'Edit Train' : 'Add Train'">

    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.trains.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-red-500 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M15 19l-7-7 7-7"/></svg>
                Back to Trains
            </a>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mt-2">{{ isset($train) ? 'Edit Train' : 'Add New Train' }}</h1>
        </div>

        <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm p-6 md:p-8">
            <form method="POST" action="{{ isset($train) ? route('admin.trains.update', $train) : route('admin.trains.store') }}" class="space-y-5">
                @csrf
                @if(isset($train)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Train Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $train->name ?? '') }}" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-gray-700 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-sm"
                            placeholder="e.g. Whoosh Set 1">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Train Code <span class="text-red-500">*</span></label>
                        <input type="text" name="train_code" value="{{ old('train_code', $train->train_code ?? '') }}" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-gray-700 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-sm font-mono"
                            placeholder="e.g. G1101">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Capacity <span class="text-red-500">*</span></label>
                        <input type="number" name="capacity" value="{{ old('capacity', $train->capacity ?? 601) }}" required min="1"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Class Type <span class="text-red-500">*</span></label>
                        <select name="class_type" required class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-sm">
                            @foreach(['Mixed', 'Economy', 'Business', 'First Class'] as $ct)
                                <option value="{{ $ct }}" {{ old('class_type', $train->class_type ?? '') === $ct ? 'selected' : '' }}>{{ $ct }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-sm">
                        @foreach(['active', 'maintenance', 'retired'] as $s)
                            <option value="{{ $s }}" {{ old('status', $train->status ?? 'active') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-gray-700 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-sm resize-none"
                        placeholder="Optional description...">{{ old('description', $train->description ?? '') }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl shadow-lg shadow-red-500/25 transition-all text-sm">
                        {{ isset($train) ? 'Update Train' : 'Create Train' }}
                    </button>
                    <a href="{{ route('admin.trains.index') }}" class="px-6 py-3 bg-gray-100 dark:bg-white/10 text-gray-600 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-200 dark:hover:bg-white/20 transition-colors text-sm">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app>
