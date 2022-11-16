@extends('layout')

@section('content')

    <h1>The dashboard for {{ $user->name }}</h1>
    <div class="row">
        <a class="btn btn-success" href="{{ route('images.create') }}">Add an Image</a>
    </div>

@endsection
