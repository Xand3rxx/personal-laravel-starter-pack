<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * The title breadcrumb title.
     *
     * @var string
     */
    public $title;

    /**
     * The sub title breadcrumb title.
     *
     * @var string
     */
    public $subTitle;

    /**
     * Create the component instance.
     *
     * @param  string  $title
     * @param  string  $subTitle
     * @return void
     */
    public function __construct($title, $subTitle)
    {
        $this->title = $title;
        $this->subTitle = $subTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
