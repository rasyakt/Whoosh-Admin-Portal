<x-layouts.app :title="isset($user) ? 'Edit User' : 'Add User'">
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.users.index') }}" class="p-2 hover:bg-gray-100 dark:hover:bg-white/10 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">{{ isset($user) ? 'Edit User' : 'Add New User' }}</h1>
        </div>
        <p class="text-sm text-gray-500 dark:text-gray-400 ml-12">{{ isset($user) ? 'Update user information' : 'Create a new mobile app user' }}</p>
    </div>

    <div class="max-w-2xl">
        <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm p-6">
            @csrf
            @if(isset($user)) @method('PUT') @endif

            <div class="space-y-6">
                {{-- Name --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Full Name <span class="text-red-600">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition-all text-slate-900 dark:text-white placeholder-gray-400 @error('name') border-red-500 @enderror"
                        placeholder="Enter full name">
                    @error('name')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Email Address <span class="text-red-600">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition-all text-slate-900 dark:text-white placeholder-gray-400 @error('email') border-red-500 @enderror"
                        placeholder="user@example.com">
                    @error('email')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition-all text-slate-900 dark:text-white placeholder-gray-400 @error('phone') border-red-500 @enderror"
                        placeholder="+62 812 3456 7890">
                    @error('phone')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">
                        Password 
                        @if(!isset($user)) <span class="text-red-600">*</span> @endif
                        @if(isset($user)) <span class="text-xs text-gray-500">(leave blank to keep current)</span> @endif
                    </label>
                    <input type="password" name="password" {{ !isset($user) ? 'required' : '' }}
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition-all text-slate-900 dark:text-white placeholder-gray-400 @error('password') border-red-500 @enderror"
                        placeholder="••••••••">
                    @error('password')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Confirmation --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2">
                        Confirm Password
                        @if(!isset($user)) <span class="text-red-600">*</span> @endif
                    </label>
                    <input type="password" name="password_confirmation" {{ !isset($user) ? 'required' : '' }}
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-[#0f0f23] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition-all text-slate-900 dark:text-white placeholder-gray-400"
                        placeholder="••••••••">
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 mt-8 pt-6 border-t border-gray-200 dark:border-white/10">
                <button type="submit" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-sm transition-colors text-sm">
                    {{ isset($user) ? 'Update User' : 'Create User' }}
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-white/10 dark:hover:bg-white/20 text-slate-700 dark:text-gray-300 font-semibold rounded-lg transition-colors text-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
