<?php

namespace App\View\Components;

use App\Models\Image;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ImageTable extends Component
{

    /** @var Collection */
    protected Collection $images;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($images)
    {
        $this->images = $images;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('components.image-table')->with('images', $this->images);
    }
}
