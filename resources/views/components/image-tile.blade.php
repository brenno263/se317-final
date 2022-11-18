<div class="card overflow-hidden h-100">
    <div class="card-header h-100">
        {{ $image->title }} by {{ $image->user->name }}
    </div>
    <a href="{{ route('users.images.show', ['user' => $image->user, 'image' => $image]) }}">
        <img class="w-100 img-fluid" src="{{ $image->thumb() }}" alt="{{ $image->title }}">
    </a>
</div>
