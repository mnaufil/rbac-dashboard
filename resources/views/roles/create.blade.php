@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    
    <!-- Header -->
    <div class="mb-8 border-b border-slate-200 pb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
            Create New Role
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Define a new security level and assign its initial set of permissions.
        </p>
    </div>

    <form method="POST" action="/roles/store">
        @csrf

        <div class="space-y-6">
            <!-- Role Name Section -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 sm:p-8">
                <div class="max-w-md">
                    <label for="name" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">
                        Role Name
                    </label>
                    <input 
                        type="text" 
                        id="name"
                        name="name" 
                        placeholder="e.g. Moderator"
                        class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-medium"
                        required
                    >
                </div>
            </div>

            <!-- Permissions Section -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6 sm:p-8">
                    <h3 class="text-sm font-black uppercase tracking-widest text-slate-500 mb-6 border-b border-slate-100 pb-2">
                        Assign Permissions
                    </h3>
                    
                    <div class="space-y-3">
                        @foreach ($permissions as $permission)
                            <label class="group relative flex items-center justify-between p-4 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-white hover:border-blue-400 hover:shadow-sm transition-all cursor-pointer">
                                <div class="flex items-center text-left">
                                    <div class="flex items-center h-6">
                                        <input 
                                            type="checkbox" 
                                            name="permissions[]" 
                                            value="{{ $permission->id }}"
                                            class="w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-blue-500 cursor-pointer"
                                        >
                                    </div>
                                    <div class="ml-4">
                                        <span class="block text-base font-bold text-slate-700 group-hover:text-blue-700 transition">
                                            {{ ucwords(str_replace(['_', '-'], ' ', $permission->name)) }}
                                        </span>
                                        <span class="block text-sm text-slate-500">
                                            Enable access to {{ strtolower($permission->name) }} modules.
                                        </span>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Action Footer -->
                <div class="px-8 py-8 bg-slate-100 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <a href="/roles" class="text-sm font-bold text-slate-500 hover:text-slate-900 transition underline underline-offset-4">
                        Discard and go back
                    </a>
                    
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto inline-flex items-center justify-center px-12 py-4 bg-slate-900 text-white rounded-xl font-black text-base hover:bg-black shadow-xl shadow-slate-200 active:scale-95 transition-all">
                        <svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M124v16m8-8H4" />
                        </svg>
                        CREATE ROLE
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection