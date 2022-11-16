@extends('layout')

@section('content')

    <h1>The dashboard for {{ $user->name }}</h1>
    <div class="row">
        <a class="btn btn-success" href="{{ route('images.create') }}">Add an Image</a>
    </div>

    <h4 class="mt-4">Recent Images:</h4>
    <div class="row">
    @foreach($recent_images as $image)
        <div class="col">
            <img src="{{ $image->asset(true) }}" width="100" height="100">
        </div>
    @endforeach
    </div>

@endsection
