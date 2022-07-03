<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardArticle extends Component
{
    public $banner;
    public $title;
    public $slug;
    public $category;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($banner, $title, $slug, $category)
    {
        $this->banner = $banner;
        $this->title = $title;
        $this->slug = $slug;
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card-article');
    }
}
