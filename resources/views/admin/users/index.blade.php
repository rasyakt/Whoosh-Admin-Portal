<x-layouts.app :title="'User Management'">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Mobile App Users</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">View registered users from the Whoossh mobile application</p>
    </div>
    <div class="mb-6">
        <form method="GET" class="relative max-w-md">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ $search }}" placeholder="Search by name, email, or phone..." class="w-full pl-12 pr-4 py-3 bg-white dark:bg-[#1e1e3a] border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all text-gray-700 dark:text-gray-200 placeholder-gray-400">
        </form>
    </div>
    <div class="bg-white dark:bg-[#1e1e3a] rounded-2xl border border-gray-200/50 dark:border-white/5 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50/80 dark:bg-white/5">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">User</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Phone</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Bookings</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-xs font-bold">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                                <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $user->phone }}</td>
                        <td class="px-6 py-4 text-center"><span class="px-2.5 py-1 bg-gray-100 dark:bg-white/10 rounded-lg text-xs font-semibold">{{ $user->bookings_count }}</span></td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="text-sm text-red-500 hover:text-red-600 font-medium">View →</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400">No users found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="p-4 border-t border-gray-100 dark:border-white/5">{{ $users->withQueryString()->links() }}</div>
        @endif
    </div>
</x-layouts.app>
