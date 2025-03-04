<?php

namespace Fuelviews\SabHeroBlog\Components;

use Fuelviews\SabHeroBlog\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeaderCategory extends Component
{
    public function render(): View
    {
        return view('sabhero-blog::components.header-category', [
            'categories' => Category::all(),
        ]);
    }
}
