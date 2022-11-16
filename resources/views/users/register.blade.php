@extends('layout')

@section('content')
    <div class="row justify-content-center my-sm-5">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-lg-4 col-form-label text-lg-end">Name</label>

                            <div class="col-lg-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                   class="col-lg-4 col-form-label text-lg-end">Email Address</label>

                            <div class="col-lg-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                   class="col-lg-4 col-form-label text-lg-end">Password</label>

                            <div class="col-lg-6">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                   class="col-lg-4 col-form-label text-lg-end">Confirm Password</label>

                            <div class="col-lg-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation"
                                       required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary form-control">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <span class="text-muted">Already have an account? <a href="{{ url('/login') }}">Login</a></span>
            </div>
        </div>
    </div>

@endsection
