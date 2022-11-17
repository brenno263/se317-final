<div class="card overflow-hidden">
    <div class="card-header">
        {{ $image->title }} by {{ $image->user->name }}
    </div>
    <a href="{{ route('images.show', ['image' => $image]) }}">
        <img class="img-fluid" src="{{ $image->thumb() }}" alt="{{ $image->title }}">
    </a>
</div>
