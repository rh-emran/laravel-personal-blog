<x-guest-layout>
    <section class="bg-white dark:bg-gray-900">
            <div class="flex justify-between max-w-screen-xl px-4 py-8 mx-auto lg:gap-12 xl:gap-12 lg:py-12">
                <div class="w-full ">
                    <div class="mb-8">
                        <img src="{{ !empty($article->image) ? asset($article->image) : asset('img/placeholder.png') }}" alt="image">
                    </div>

                    <h1 class=" mb-4 text-4xl font-extrabold text-justify tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                        {{ $article->title }}
                    </h1>

                    <p class="mb-2 font-light text-gray-400 lg:mb-2 md:text-sm lg:text-md dark:text-gray-500">Posted by: {{ $article->author->name }}</p>
                    <p class="mb-2 font-light text-gray-400 lg:mb-2 md:text-sm lg:text-md dark:text-gray-500">Posted at: {{ date('F-j, Y',strtotime($article->created_at)) }}</p>
                    <p class="mb-2 font-light text-gray-400 lg:mb-2 md:text-sm lg:text-md dark:text-gray-500">Category: {{ $article->category->name }}</p>
                    <p class="mb-6 font-light text-gray-400 lg:mb-8 md:text-sm lg:text-md dark:text-gray-500">Tags:
                        @foreach($article->tags as $tag)
                            <span class="bg-green-100 text-green-800 leading-8 text-md font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-200">{{ $tag->name }}</span>
                        @endforeach
                    </p>
                    <hr />
                    <p class="my-8 font-light text-justify text-gray-500 lg:mb-4 md:text-lg lg:text-xl dark:text-gray-400">{{ $article->full_text }}</p>
                </div>
            </div>
    </section>
</x-guest-layout>
