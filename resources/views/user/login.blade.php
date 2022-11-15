@extends('layout')

@section('content')
    <div class="row justify-content-center mt-sm-3">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/login') }}">
                        @csrf

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

                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <span class="text-muted">Already have an account? <a href="{{ url('/register') }}">Login</a></span>
            </div>
        </div>
    </div>

@endsection
