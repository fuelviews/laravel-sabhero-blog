<x-sabhero-article-layout>
    <section class="py-8">
        <div class="container mx-auto">
            <div class="mx-auto mb-12 space-y-10">
                <div class="">
                    <div class="space-y-10">
                        <div>
                            <div class="flex flex-col justify-end">
                                <div class="mb-16 h-full w-full overflow-hidden bg-slate-200 rounded-2xl shadow-2xl">

                                    @if ($post->hasMedia('post_feature_image'))
                                        <img
                                            srcset="{{ $post->getFirstMedia('post_feature_image')->getSrcset() }}"
                                            src="{{ $post->getFirstMedia('post_feature_image')->getUrl() }}"
                                            alt="{{ $post->feature_image_alt_text }}"
                                            class="flex h-full min-h-[400px] items-center justify-center object-cover object-top"
                                            loading="eager"
                                        >
                                    @else
                                        <p>No featured image available.</p>
                                    @endif
                                </div>
                                <div class="">
                                    <p class="mb-4 text-4xl font-semibold">
                                        {{ $post->title }}
                                    </p>
                                    <p>{{ $post->sub_title }}</p>
                                </div>
                                <hr class="my-12 h-[2px] border-t-0 bg-transparent bg-gradient-to-r from-transparent via-slate-200">
                                <div>
                                    <article class="w-full mx-auto">
                                        <x-sabhero-article-markdown :content="$post->body" />
                                    </article>
                                </div>
                                <hr class="my-12 h-[2px] border-t-0 bg-transparent bg-gradient-to-r from-transparent via-slate-200">
                                <div class="flex flex-wrap items-center gap-4">
                                    <x-sabhero-article::author-profile :user="$post->user" :post="$post" size="large" />
                                    <div class="flex flex-wrap gap-2 min-w-0 flex-1 justify-end">
                                        @foreach ($post->categories as $category)
                                            <x-sabhero-article::category-button :category="$category" size="medium" />
                                        @endforeach
                                        @foreach ($post->tags as $tag)
                                            <x-sabhero-article::tag-button :tag="$tag" size="medium" />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <div class="relative mb-6 flex items-center gap-x-8">
                        <h2 class="whitespace-nowrap text-xl font-semibold">
                            <span class="font-bold">#</span> Related Posts
                        </h2>
                        <div class="flex w-full items-center">
                            <span class="h-[2px] w-full rounded-full bg-gradient-to-r from-slate-200 to-transparent"></span>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-x-12 gap-y-10">
                        @forelse($post->relatedPosts() as $post)
                            <x-sabhero-article::card :post="$post" />
                        @empty
                        <div class="col-span-3">
                            <p class="text-center text-xl font-semibold text-gray-300">No related posts found.</p>
                        </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </section>
</x-sabhero-article-layout>
