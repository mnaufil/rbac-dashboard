@extends('layouts.app')

@section('title', 'User Management')

@section('content')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Users</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your application users and their account status.</p>
        </div>
        <a href="/users/create" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 transition">
            Add User
        </a>
    </div>

    <div class="overflow-hidden bg-white shadow sm:rounded-lg border border-gray-200">
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
    </div>
@endsection