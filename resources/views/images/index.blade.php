@extends('layout')

@section('content')

    @php($showControls = auth()->user() && auth()->user()->id == $user->id)

    <x-image-paginator
        :paginator="$paginator"
        show-username
        show-controls="$showControls"
    ></x-image-paginator>

@endsection