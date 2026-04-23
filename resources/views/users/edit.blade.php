@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="max-w-2xl mx-auto"> <div class="mb-4">
        <a href="/users" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 flex items-center gap-1">
            ← Back to Users
        </a>
    </div>

    <div class="bg-white shadow sm:rounded-lg border border-gray-200">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-semibold leading-6 text-gray-900">Edit User Profile</h3>
            <p class="mt-1 text-sm text-gray-500">Update the account information and email address for this user.</p>

            <form method="POST" action="/users/{{ $user->id }}" class="mt-6 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Full Name</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email Address</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                @can('access-admin')
                <div class="mb-3">
                    <label>Role</label>

                    <select name="role" class="w-full border p-2 rounded">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                @if($user->roles->first()?->id == $role->id) selected @endif>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endcan

                <div class="flex items-center justify-end gap-x-3 border-t border-gray-900/10 pt-6">
                    <a href="/users" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    <button type="submit" 
                        class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection