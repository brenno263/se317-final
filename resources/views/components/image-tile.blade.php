<div class="card overflow-hidden">
    <div class="card-header">
        {{ $image->title }} by {{ $image->user->name }}
    </div>
    <a href="{{ route('users.images.show', ['user' => $image->user, 'image' => $image]) }}">
        <img class="img-fluid" src="{{ $image->thumb() }}" alt="{{ $image->title }}">
    </a>
</div>
