@extends('layout')

@section('content')
    <div class="row justify-content-center my-sm-5">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">Edit Image</div>
                <div class="card-body">
                    <form method="POST"
                          action="{{ route('users.images.update', ['user' => $user, 'image' => $image]) }}"
                          enctype="multipart/form-data">
                        @method("PATCH")
                        @csrf

                        <div class="row justify-content-center mb-sm-4">
                            <img class="img-fluid w-50" src="{{ $image->thumb() }}" alt="{{ $image->title }}">
                        </div>

                        <div class="row mb-3">
                            <label for="title"
                                   class="col-lg-4 col-form-label text-lg-end">Title*</label>

                            <div class="col-lg-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                       name="title" value="{{ old('title') ?: $image->title }}" required>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="description" class="col-lg-4 col-form-label text-lg-end">Description</label>

                            <div class="col-lg-6">
                                <textarea id="description"
                                          class="form-control @error('description')is-invalid @enderror"
                                          name="description"
                                          rows="3">{{ old('description') ?: $image->description }}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="public" class="col-lg-4 col-auto col-form-label text-lg-end">Publicly
                                Visible</label>

                            <div class="col-auto d-inline-flex align-content-center">
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
