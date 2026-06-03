@extends('layouts.app')

@section('title', 'Activity Logs')

@section('content')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Activity Logs</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Track all user actions and system events.</p>
        </div>
    </div>

    <div class="overflow-hidden bg-white shadow sm:rounded-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <livewire:activity-log-table />
        {{-- <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="w-1/6 py-4 pl-6 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">User</th>
                    <th scope="col" class="w-1/6 px-3 py-4 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Action</th>
                    <th scope="col" class="px-3 py-4 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Description</th>
                    <th scope="col" class="w-1/6 px-6 py-4 text-right text-sm font-semibold text-gray-900 dark:text-gray-100">Time</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                @forelse($logs as $log)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $log->user->name ?? 'Deleted User' }}
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm">
                            <span class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-600/20 dark:bg-indigo-900/30 dark:text-indigo-300 dark:ring-indigo-500/30">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-600 dark:text-gray-300">
                            {{ $log->description }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-500 dark:text-gray-400">
                            {{ $log->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                            No activity logs found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table> --}}

        @if($logs->hasPages())
            <div class="border-t border-gray-200 dark:border-gray-700 px-6 py-4">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
@endsection
