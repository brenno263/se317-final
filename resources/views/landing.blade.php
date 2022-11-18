@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-auto">
                <h1>Welcome to the Gallery!</h1>
                <p>These are the most recent images uploaded to the site.</p>
            </div>
            <div class="col-md-auto">
                <div class="row justify-content-center g-3">
                    <div class="col-sm-6 col-md-12">
                        <a class="btn btn-success w-100" href="{{ route('images.public-index') }}">View all images</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <x-image-table :images="$recentImages"></x-image-table>

    <div class="container">
        <div class="row justify-content-center g-3">
            <div class="col-sm-6">
                <a class="btn btn-success w-100" href="{{ route('images.public-index') }}">View all images</a>
            </div>
        </div>
    </div>

@endsection
