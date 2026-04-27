@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-5">Roles</h1>

@foreach ($roles as $role)
    <div class="bg-white p-4 mb-3 shadow rounded">
        <strong>{{ $role->name }}</strong>

        <a href="/roles/{{ $role->id }}/edit"
           class="ml-5 bg-blue-500 text-white px-3 py-1 rounded">
            Manage Permissions
        </a>
    </div>
@endforeach

@endsection