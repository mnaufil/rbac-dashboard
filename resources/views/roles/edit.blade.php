@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    
    <div class="mb-8 border-b border-slate-200 pb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
            Manage Permissions
        </h1>
        <div class="mt-2 flex items-center gap-2">
            <span class="text-slate-500">Assigning access to:</span>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-black uppercase rounded-full tracking-widest">
                {{ $role->name }}
            </span>
        </div>
    </div>

    <form method="POST" action="/roles/{{ $role->id }}">
        @csrf
        @method('PUT')

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            
            <div class="p-6 sm:p-10">
                <h3 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-2">Available Permissions</h3>
                <a href="/roles" class="text-sm font-bold text-slate-500 hover:text-slate-900 transition underline underline-offset-4">
                    Cancel and go back
                </a>
                <div class="space-y-3">
                    @foreach ($permissions as $permission)
                        <label class="group relative flex items-center justify-between p-4 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-white hover:border-blue-400 hover:shadow-sm transition-all cursor-pointer">
                            <div class="flex items-center">
                                <div class="flex items-center h-6">
                                    <input 
                                        type="checkbox" 
                                        name="permissions[]" 
                                        value="{{ $permission->id }}"
                                        class="w-5 h-5 text-blue-600 border-slate-300 rounded focus:ring-blue-500 cursor-pointer"
                                        @if($role->permissions->contains($permission->id)) checked @endif
                                    >
                                </div>
                                <div class="ml-4">
                                    <span class="block text-base font-bold text-slate-700 group-hover:text-blue-700 transition">
                                        {{ ucwords(str_replace(['_', '-'], ' ', $permission->name)) }}
                                    </span>
                                    <span class="block text-sm text-slate-500">
                                        Grants access to {{ strtolower($permission->name) }} features.
                                    </span>
                                </div>
                            </div>

                            @if($role->permissions->contains($permission->id))
                                <span class="hidden sm:block text-[10px] font-bold text-blue-500 uppercase">Current Access</span>
                            @endif
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="px-8 py-8 bg-slate-100 border-t border-slate-200 flex       flex-col sm:flex-row items-center justify-between gap-4">
                

                <button 
                    type="submit" 
                    class="w-full sm:w-auto inline-flex items-center justify-center px-12 py-4  rounded-xl font-black text-base hover:bg-black shadow-lg shadow-slate-400/50 active:scale-95 transition-all"
                >
                    <svg class="w-5 h-5 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    SAVE CHANGES
                </button>
            </div>
        </div>
    </form>
</div>
@endsection