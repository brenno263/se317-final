<div class="container p-3">
    <div class="row g-3">
        @foreach($images as $image)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <x-image-tile :image="$image"></x-image-tile>
            </div>
        @endforeach
    </div>
</div>
