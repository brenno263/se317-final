<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('landing') }}">Image Gallery</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                @if($user = auth()->user())
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dashboard', ['users' => $user]) }}">Dashboard</a>
                </li>
                @endif
                {{--                <li class="nav-item dropdown">--}}
                {{--                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
                {{--                        Dropdown--}}
                {{--                    </a>--}}
                {{--                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
                {{--                        <li><a class="dropdown-item" href="#">Action</a></li>--}}
                {{--                        <li><a class="dropdown-item" href="#">Another action</a></li>--}}
                {{--                        <li><hr class="dropdown-divider"></li>--}}
                {{--                        <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
            </ul>

            <div class="d-flex">

                @if(auth()->user())
                    <a class="text-muted" href="{{ route('logout') }}">Log Out</a>
                @else
                    <a class="text-muted" href="{{ route('login') }}">Log In</a>
                @endif
            </div>


            {{--            <form class="d-flex">--}}
            {{--                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">--}}
            {{--                <button class="btn btn-outline-success" type="submit">Search</button>--}}
            {{--            </form>--}}
        </div>
    </div>
</nav>