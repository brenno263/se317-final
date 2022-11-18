{{ $imagePaginator->links() }}

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead>
        <tr>
            @if($showUsername)
                <th scope="col">Username</th>
            @endif
            <th scope="col">Title</th>
            <th scope="col">Controls</th>
            <th scope="col">Image</th>
        </tr>
        </thead>
        <tbody class="text">
        @foreach($imagePaginator as $image)
            <tr>
                @if($showUsername)
                    <td class="text-break" style="min-width: 80px">{{ $image->user->name }}</td>
                @endif
                <td class="text-break" style="min-width: 80px">{{ $image->title }}</td>
                <td>
                    <div class="w-100 h-100 d-flex flex-column align-content-center gap-2">
                        <a href="{{ route('users.images.show', ['user' => $image->user, 'image' => $image]) }}" class="btn
                           btn-success">View</a>
                        @if($showControls)
                        <a href="{{ route('users.images.edit', ['user' => $image->user, 'image' => $image]) }}" class="btn
                           btn-primary">Edit</a>
                        <a href="{{ route('users.images.destroy-confirm', ['user' => $image->user, 'image' => $image]) }}"
                           class="btn btn-danger">Delete</a>
                        @endif
                    </div>
                </td>
                <td><img src="{{ $image->thumb() }}" alt="{{ $image->title }}" height="200px"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{ $imagePaginator->links() }}
