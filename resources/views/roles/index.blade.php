@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Roles & Access Control</h1>
            <p class="text-sm text-slate-500 mt-1">Define and manage the permission levels for your system users.</p>
        </div>
        
        {{-- Optional: Add Role Button --}}
        <button class="inline-flex items-center px-5 py-2.5 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-black transition-all active:scale-95 shadow-lg shadow-slate-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v12m6-6H6"/></svg>
            Create New Role
        </button>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-500">Role Name</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-500">Slug / Identifier</th>
                        <th class="px-6 py-4 text-right text-xs font-black uppercase tracking-widest text-slate-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($roles as $role)
                    <tr class="group hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($role->name, 0, 1)) }}
                                </div>
                                <span class="text-base font-bold text-slate-900">{{ $role->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <code class="text-xs font-mono bg-slate-100 text-slate-600 px-2 py-1 rounded">
                                {{ strtolower($role->name) }}
                            </code>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <a href="/roles/{{ $role->id }}/edit" 
                               class="inline-flex items-center gap-2 px-5 py-2 rounded-xl text-blue-700 bg-blue-50 hover:bg-blue-600 hover:text-white transition-all duration-200 font-bold text-sm shadow-sm shadow-blue-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                                Manage Permissions
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-center gap-2 text-slate-400">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-xs font-medium">Changes to roles may require users to re-login to see updated permissions.</p>
    </div>
</div>
@endsection