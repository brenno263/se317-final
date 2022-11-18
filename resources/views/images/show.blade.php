@extends('layout')

@section('content')
    <div class="row g-2 mb-3">
        <div class="col-sm-auto">
            <a class="btn btn-dark w-100" href="{{ url()->previous() }}">Go Back</a>
        </div>
        @if(auth()->user() && $user->id == auth()->user()->id)
            <div class="col-sm-auto">
                <a class="btn btn-primary w-100"
                   href="{{ route('users.images.edit', ['user' => $user, 'image' => $image]) }}">Edit</a>
            </div>
            <div class="col-sm-auto">
                <a class="btn btn-danger w-100"
                   href="{{ route('users.images.destroy-confirm', ['user' => $user, 'image' => $image]) }}">Delete</a>
            </div>
        @endif
    </div>
    <div class="row gy-2">
        <div class="col-md-8">
            <img class="img-fluid w-100" src="{{ $image->asset() }}" alt="{{ $image->title }}">
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4>
                        {{ $image->title }}
                    </h4>
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <p class="h-auto align-text-top">{{ $image->description }}</p>
                    <a class="text-muted align-text-bottom mb-0">{{ $user->name }}</a>
                </div>
            </div>

        </div>
    </div>

@endsection
