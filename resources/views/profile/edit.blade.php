@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-5">Profile</h1>

<div class="bg-white p-5 shadow rounded mb-5">
    @include('profile.partials.update-profile-information-form')
</div>

<div class="bg-white p-5 shadow rounded mb-5">
    @include('profile.partials.update-password-form')
</div>

<div class="bg-white p-5 shadow rounded">
    @include('profile.partials.delete-user-form')
</div>

@endsection