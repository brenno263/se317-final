@extends('layout')

@section('content')

    <div class="row justify-content-between mb-3">
        <div class="col-auto">
            <h1>Welcome to the Gallery!</h1>
            <p>These are the most recent images uploaded to the site.</p>
        </div>
        <div class="col-md-auto">
            <div class="row justify-content-center g-3">
                <div class="col-sm-6 col-md-12">
                    <a class="btn btn-secondary w-100" href="{{ route('landing') }}">Back to Landing Page</a>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <h2>Public Images</h2>
            <p>This is a collection of all publicly visible images.</p>
        </div>
    </div>
    <x-image-paginator
        :paginator="$paginator"
        show-username
    ></x-image-paginator>

@endsection
