<div class="space-y-6">
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
        
        <div class="flex flex-1 items-center max-w-2xl group shadow-sm rounded-xl">
            <div class="relative flex-1 group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-20">
                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input 
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search logs by keyword..."
                    class="block w-full pl-11 pr-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-l-xl text-sm text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:z-10 transition-all"
                >
            </div>

            <div class="relative">
                <select 
                    wire:model.live="action" 
                    class="block h-[46px] pl-4 pr-10 py-2.5 bg-slate-50 dark:bg-slate-900 border-y border-r border-slate-300 dark:border-slate-700 rounded-r-xl border-l border-l-slate-200 dark:border-l-slate-700/50 text-xs font-black uppercase tracking-widest text-slate-600 dark:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:z-10 transition-all cursor-pointer appearance-none"
                >
                    <option value="">All Actions</option>
                    <option value="delete-user">Delete User</option>
                    <option value="update-user">Update User</option>
                    <option value="change-role">Change Role</option>
                    <option value="create-role">Create Role</option>
                    <option value="delete-role">Delete Role</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 self-end sm:self-center">
            <div wire:loading wire:target="search, action">
                <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 whitespace-nowrap">
                Logged Records: <span class="text-blue-600 font-bold">{{ $logs->total() }}</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-2xl shadow-black/20 overflow-hidden border border-slate-200">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-400">User</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-400">Action</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-400">Description</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-400 text-right">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($logs as $log)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-slate-100 border border-slate-200 text-slate-600 flex items-center justify-center font-bold text-xs">
                                        {{ strtoupper(substr($log->user->name ?? 'D', 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-bold text-slate-700">{{ $log->user->name ?? 'Deleted User' }}</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $isDelete = str_contains($log->action, 'delete');
                                    $isCreate = str_contains($log->action, 'create');
                                    $badgeClasses = $isDelete 
                                        ? 'bg-rose-50 text-rose-600 border-rose-100' 
                                        : ($isCreate ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-blue-50 text-blue-600 border-blue-100');
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[10px] font-black uppercase tracking-wider border {{ $badgeClasses }}">
                                    {{ str_replace('-', ' ', $log->action) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm text-slate-600 font-medium max-w-md truncate">
                                {{ $log->description }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-mono text-slate-400 font-semibold">
                                {{ $log->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-16 text-center">
                                <div class="flex flex-col items-center justify-center gap-2 text-slate-400">
                                    <svg class="w-8 h-8 stroke-current opacity-60" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                    <p class="text-sm font-bold tracking-tight text-slate-500">No activity logs matching criteria.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 px-2">
        {{ $logs->links() }}
    </div>
</div>