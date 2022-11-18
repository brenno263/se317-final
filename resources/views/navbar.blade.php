@php
    $authorizedUser = auth()->user();
@endphp

<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('landing') }}">Image Gallery</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                @if($authorizedUser)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                           href="{{ route('dashboard', ['users' => $authorizedUser]) }}">Dashboard</a>
                    </li>
                @endif
            </ul>

            <ul class="navbar-nav mb-2 mb-sm-0">
                @if(!$authorizedUser)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
                <li class="nav-item">
                    @if($authorizedUser)
                        <a class="nav-link" href="{{ route('logout') }}">Log Out</a>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Log In</a>
                    @endif
                </li>
            </ul>

            {{--            <form class="d-flex">--}}
            {{--                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">--}}
            {{--                <button class="btn btn-outline-success" type="submit">Search</button>--}}
            {{--            </form>--}}
        </div>
    </div>
</nav>
