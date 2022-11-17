@extends('layout')

@section('content')

    <h1>The dashboard for {{ $user->name }}</h1>
    <div class="row">
        <a class="btn btn-success" href="{{ route('images.create') }}">Add an Image</a>
    </div>

    <h4 class="mt-4">Recent Images:</h4>
    <div class="container p-3">
        <div class="row g-3">
            @foreach($recent_images as $image)
                <div class="col-lg-3 col-md-4">
                    <x-image-tile :image="$image"></x-image-tile>
                </div>
            @endforeach
        </div>
    </div>

@endsection
