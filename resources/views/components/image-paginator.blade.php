<div class="row justify-content-center my-3">
    <div class="col-xxl-9 col-xl-10 col-12">

        {{ $imagePaginator->links() }}

        <div class="table-responsive my-3">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                <tr>
                    @if($showUsername)
                        <th scope="col">Username</th>
                    @endif
                    <th scope="col">Title</th>
                    @if($showControls)
                        <th scope="col">Controls</th>
                    @endif
                    <th scope="col">Image</th>
                </tr>
                </thead>
                <tbody class="text">
                @foreach($imagePaginator as $image)
                    <tr>
                        @if($showUsername)
                            <td class="text-break" style="min-width: 80px">{{ $image->user->name }}</td>
                        @endif
                        <td class="text-break w-100" style="min-width: 80px">{{ $image->title }}</td>
                        @if($showControls)
                            <td>
                                <div class="w-100 h-100 d-flex flex-column align-content-center gap-2">
                                    <a href="{{ route('users.images.show', ['user' => $image->user, 'image' => $image]) }}"
                                       class="btn
                           btn-success">View</a>

                                    <a href="{{ route('users.images.edit', ['user' => $image->user, 'image' => $image]) }}"
                                       class="btn
                           btn-primary">Edit</a>
                                    <a href="{{ route('users.images.destroy-confirm', ['user' => $image->user, 'image' => $image]) }}"
                                       class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                        @endif
                        <td style="padding: 1px" >
                            <a href="{{ route('users.images.show', ['user' => $image->user, 'image' => $image]) }}">
                                <img src="{{ $image->thumb() }}" alt="{{ $image->title }}"
                                     height="180px">
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $imagePaginator->links() }}

    </div>
</div>


