<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
     @can('view-user')
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="relative overflow-hidden bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-widest">Total Users</p>
                        <h3 class="text-4xl font-black text-slate-900 mt-1">{{ $stats['users'] }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs font-bold text-emerald-600 bg-emerald-50 w-fit px-2 py-1 rounded-lg">
                    {{-- <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    12% increase --}}
                </div>
            </div>

            <div class="relative overflow-hidden bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-widest">Active Roles</p>
                        <h3 class="text-4xl font-black text-slate-900 mt-1">{{ $stats['roles'] }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 text-xs font-bold text-slate-400">
                    System-wide security levels
                </div>
            </div>

            <div class="relative overflow-hidden bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-widest">Permissions</p>
                        <h3 class="text-4xl font-black text-slate-900 mt-1">{{ $stats['permissions'] }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 text-xs font-bold text-slate-400">
                    Granular access nodes
                </div>
            </div>

        </div>
   
        <div class="mt-10 bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900 tracking-tight">Recent Users</h2>
                <a href="/users" class="text-xs font-bold text-blue-600 hover:text-blue-700 uppercase tracking-widest transition">
                    View All Users →
                </a>
            </div>

            <div class="divide-y divide-slate-100">
                @foreach($recentUsers as $user)
                    <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50/50 transition-colors group">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 font-bold text-sm group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 transition-all">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            
                            <div>
                                <p class="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition">
                                    {{ $user->name }}
                                </p>
                                <p class="text-xs text-slate-500 font-medium">
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>

                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter">
                                Joined {{ $user->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($recentUsers->isEmpty())
                <div class="p-10 text-center">
                    <p class="text-sm text-slate-400 font-medium italic">No users found recently.</p>
                </div>
            @endif
        </div>
    @endcan
        
    </x-slot>

    

    
</x-app-layout>
