<?php

namespace App\View\Components;

use App\Models\Image;
use Illuminate\View\Component;

class ImageTile extends Component
{

    /**
     * The image to display in this tile.
     * @var Image
     */
    public $image;

    /**
     * Create a new component instance.
     *
     * @param Image $image
     * @return void
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('components.image-tile')->with('image', $this->image);
    }
}
