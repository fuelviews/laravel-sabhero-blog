<?php

namespace Fuelviews\SabHeroBlog\Components;

use Fuelviews\SabHeroBlog\Models\Post;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class RecentPost extends Component
{
    public function render(): View
    {
        $posts = Post::query()->published()->whereNot('slug', request('post')->slug)->latest()->take(5)->get();

        return view('sabhero-blog::components.recent-post', [
            'posts' => $posts,
        ]);
    }
}
