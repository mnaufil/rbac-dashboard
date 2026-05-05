<div>
    <div class="mb-2 m-2 flex items-center gap-4">
        <!-- Search Group -->
        <div class="relative flex items-center group w-fit">
        <!-- Search Icon -->
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-20">
            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

        <input 
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Search by name or email..."
            class="block w-[500px] max-w-2xl pl-11 pr-4 py-2.5  border-slate-700 rounded-l-xl text-sm  placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:z-10 transition-all"
        >
        
        <!-- Results Badge (Attached to Input) -->
        <div class="flex items-center h-[46px] px-6 bg-slate-800 border-y border-r border-slate-700 rounded-r-xl border-l border-l-slate-700/50">
            <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 whitespace-nowrap">
                <span class="text-blue-400">{{ $users->count() }}</span> Results
            </span>
        </div>
    </div>

        <!-- Loading Indicator (Optional but recommended) -->
        <div wire:loading wire:target="search">
            <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>                                                                                                                                                                                                                                                                                           
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="w-1/4 py-4 pl-6 pr-3 text-left text-sm font-semibold text-gray-900">Name</th>
                <th scope="col" class="w-1/3 px-3 py-4 text-left text-sm font-semibold text-gray-900">Email</th>
                <th scope="col" class="w-1/6 px-3 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                <th scope="col" class="px-6 py-4 text-right text-sm font-semibold text-gray-900">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            @foreach ($users as $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900">
                        {{ $user->name }}
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600">
                        {{ $user->email }}
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                        <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                            Active
                        </span>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium space-x-4">
                        <a href="/users/{{ $user->id }}/edit" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        
                        <form method="POST" action="/users/{{ $user->id }}" class="inline" onsubmit="return confirm('Delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>