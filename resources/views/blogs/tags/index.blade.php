<x-sabhero-blog-layout>
    <section class="py-8">
        <div class="container mx-auto">
            <h2 class="inherits-color text-balance leading-tighter text-3xl font-semibold tracking-tight pb-8">Browse by Tag</h2>
            <div class="flex flex-wrap gap-x-2">
                @foreach($tags as $tag)
                    <a href="{{ route('sabhero-blog.tag.post', ['tag' => $tag->slug]) }}">
                        <span class="rounded-full inline-flex border border-slate-300 px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">
                            <x-heroicon-m-hashtag class="mr-1.5 inline-flex h-5 w-5 text-prime-600" />
                            {{ $tag->name }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @if(count($posts))
        <section class="pt-8">
            <div class="container mx-auto">
                <div class="">
                    @foreach ($posts->take(1) as $post)
                        <div>
                            <x-sabhero-blog::feature-card :post="$post" />
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="py-8">
            <div class="container mx-auto">
                <div class="grid sm:grid-cols-3 gap-x-14 gap-y-14">
                    @foreach ($posts->skip(1) as $post)
                        <x-sabhero-blog::card :post="$post" />
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            </div>
        </section>
    @else
        <div class="container mx-auto">
            <div class="flex justify-center">
                <p class="text-2xl font-semibold text-gray-300">No tags found</p>
            </div>
        </div>
    @endif
</x-sabhero-blog-layout>
