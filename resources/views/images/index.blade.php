@extends('layout')

@section('content')

    @php
    $authUser = auth()->user();
    $owning = $authUser && $authUser->id == $user->id;
    @endphp

    <h1>Viewing {{ $user->name }}'s gallery</h1>
    @if($owning)
        <div class="container mb-3 my-3">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <a class="w-100 btn btn-success" href="{{ route('users.images.create', ['user' => $user]) }}">Add an Image</a>
                </div>
            </div>
        </div>

    @endif

    <x-image-paginator
        :paginator="$paginator"
        :show-username="!$owning"
        :show-controls="$owning"
    ></x-image-paginator>

@endsection
