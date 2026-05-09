@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Roles & Access Control</h1>
            <p class="text-sm text-slate-500 mt-1">Define and manage the permission levels for your system users.</p>
        </div>
        
        <a href="{{ route('roles.create') }}" 
           class="inline-flex items-center px-5 py-2.5 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-black transition-all active:scale-95 shadow-lg shadow-slate-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v12m6-6H6"/>
            </svg>
            Create New Role
        </a>
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
                            <div class="flex justify-end items-center gap-3">
                                {{-- Edit Button --}}
                                <a href="/roles/{{ $role->id }}/edit" 
                                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-blue-700 bg-blue-50 hover:bg-blue-600 hover:text-white transition-all duration-200 font-bold text-xs shadow-sm shadow-blue-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Manage
                                </a>

                                {{-- Delete Button --}}
                                <form action="/roles/{{ $role->id }}" method="POST" onsubmit="return confirm('Are you sure? This will remove all permissions associated with this role.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-rose-600 bg-rose-50 hover:bg-rose-600 hover:text-white transition-all duration-200 font-bold text-xs shadow-sm shadow-rose-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
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