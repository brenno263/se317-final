@extends('layout')

@section('content')
    <div class="row justify-content-center my-sm-5">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">Destroy Image</div>
                <div class="card-body">
                    <form method="POST"
                          action="{{ route('users.images.destroy', ['user' => $user, 'image' => $image]) }}"
                          enctype="multipart/form-data">
                        @method("DELETE")
                        @csrf

                        <div class="row justify-content-center mb-sm-4">
                            <img class="img-fluid w-50" src="{{ $image->thumb() }}" alt="{{ $image->title }}">
                        </div>

                        <div class="alert alert-danger">
                            Are you really sure you want to DESTROY this image? It'll seriously be gone forever!
                        </div>

                        <div class="row mb-3 justify-content-center">
                            <div class="col-auto d-flex">
                                <label for="obliterate" class="col-form-label text-lg-end">
                                    OBLITERATE IMAGE
                                </label>

                                <div class="d-inline-flex align-content-center ms-3">
                                    <input id="obliterate" type="checkbox" class="form-check-input my-auto" name="obliterate" required>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary w-100">DESTROY</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
