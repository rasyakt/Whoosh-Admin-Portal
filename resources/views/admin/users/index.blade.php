<x-layouts.app :title="'User Management'">
    <div class="mb-6 flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Mobile App Users</h1>
            <p class="text-sm text-gray-500 mt-1">View registered users from the Whoosh mobile application</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-sm transition-colors text-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add User
        </a>
    </div>
    <div class="mb-6">
        <form method="GET" class="relative max-w-md">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ $search }}" placeholder="Search by name, email, or phone..." class="w-full pl-12 pr-4 py-3 bg-white dark:bg-[#1a1a2e] border border-gray-200 dark:border-white/10 rounded-lg text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors text-slate-900 dark:text-white placeholder-gray-400 shadow-sm">
        </form>
    </div>
    <div class="bg-white dark:bg-[#1a1a2e] rounded-xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left min-w-[800px]">
                <thead class="bg-gray-50 dark:bg-white/5 text-slate-600 dark:text-gray-400 text-xs uppercase font-bold tracking-wider border-b border-gray-200 dark:border-white/10">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">User</th>
                        <th class="px-6 py-4 whitespace-nowrap">Email</th>
                        <th class="px-6 py-4 whitespace-nowrap">Phone</th>
                        <th class="px-6 py-4 text-center whitespace-nowrap">Bookings</th>
                        <th class="px-6 py-4 text-right whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50/80 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-700 dark:text-blue-400 text-sm font-bold">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                                <span class="font-bold text-slate-900 dark:text-gray-200">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-gray-500 whitespace-nowrap">{{ $user->phone }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap"><span class="px-3 py-1 bg-gray-100 dark:bg-[#0f0f23] rounded-md text-xs font-bold">{{ $user->bookings_count }}</span></td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end overflow">
                                <x-table-actions-dropdown 
                                    :viewRoute="route('admin.users.show', $user->id)"
                                    :editRoute="route('admin.users.edit', $user->id)"
                                    :deleteRoute="route('admin.users.destroy', $user->id)"
                                />
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400 font-medium">No users found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="p-4 border-t border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/5">{{ $users->withQueryString()->links() }}</div>
        @endif
    </div>
</x-layouts.app>
