@extends('layout')

@section('content')

    <h1>The dashboard for {{ $user->name }}</h1>
    <div class="row">
        <a class="btn btn-success" href="{{ route('users.images.create', ['user' => $user]) }}">Add an Image</a>
    </div>

    <h4 class="mt-4">Recent Images:</h4>
    <x-image-table :images="$recent_images"></x-image-table>
@endsection
