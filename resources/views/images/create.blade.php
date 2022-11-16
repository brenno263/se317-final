@extends('layout')

@section('content')
    <div class="row justify-content-center my-sm-5">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">Create an Image</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('images.store') }}" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <label for="title"
                                   class="col-lg-4 col-form-label text-lg-end">Title*</label>

                            <div class="col-lg-6">
                                <input id="title" type="text" class="form-control @error('email') is-invalid @enderror"
                                       name="title" value="{{ old('email') }}" required>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-lg-4 col-form-label text-lg-end">Upload</label>
                            <div class="col-lg-6">
                                <input id="image" type="file" class="form-control" name="image">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-lg-4 col-form-label text-lg-end">Description</label>

                            <div class="col-lg-6">
                                <textarea id="description" class="form-control" name="description" rows="3"></textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="public" class="col-lg-4 col-form-label text-lg-end">Publicly Visible</label>

                            <div class="col-lg-6 d-inline-flex align-content-center">
                                <input id="public" type="checkbox" class="form-check-input my-auto" name="public"
                                       checked>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
