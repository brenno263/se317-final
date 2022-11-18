<?php

namespace App\View\Components;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\Component;

class ImagePaginator extends Component
{
    /** @var Paginator */
    protected Paginator $paginator;

    protected bool $showUsername;

    protected bool $showControls;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Paginator $paginator, bool $showUsername = false, bool $showControls = false)
    {
        $this->paginator = $paginator;
        $this->showUsername = $showUsername;
        $this->showControls = $showControls;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.image-paginator')->with([
            'imagePaginator' => $this->paginator,
            'showUsername' => $this->showUsername,
            'showControls' => $this->showControls,
        ]);
    }
}
