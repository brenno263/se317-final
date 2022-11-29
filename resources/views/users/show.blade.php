@extends('layout')

@section('content')
    <h1>User View</h1>
    <p class="my-3">Viewing the account for {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>

    <a class="btn btn-success my-3" href="{{ route('users.images.index', ['user' => $user]) }}">View Images</a>

    <p class="my-3 mt-5">Warning, the button below will delete your account instantly, along with all your images.
        Ideally there would be a confirmation page, but to be entirely transparent I sort of can't be bothered at the
        moment.</p>
    <form action="{{ route('users.destroy', ['user' => $user]) }}" method="POST">
        @method('DELETE')
        @csrf
        <input type="submit" class="btn btn-danger" value="DELETE MY ACCOUNT" >
    </form>

@endsection
