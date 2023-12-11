<x-guest-layout>
    <section class="bg-white dark:bg-gray-900">
{{--        @if(!empty($article))--}}
{{--            @dd($article)--}}
{{--        @php var_dump($data) @endphp--}}
            <div class="flex justify-between max-w-screen-xl px-4 py-8 mx-auto lg:gap-12 xl:gap-12 lg:py-12">
                <div class="w-full ">
                    <div class="mb-8">
                        <img src="{{ !empty($article->image) ? asset($article->image) : asset('img/placeholder.png') }}" alt="image">
{{--                        <img src="{{ !empty($article->image) ? $article->image : asset('img/placeholder.png') }}" alt="image">--}}
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
{{--        @endif--}}


            {{--        @if(!empty($articles))--}}
{{--            @foreach($articles as $article)--}}
{{--                <div class="flex justify-between max-w-screen-xl px-4 py-8 mx-auto lg:gap-12 xl:gap-12 lg:py-12 border-b">--}}
{{--                    <div class="w-full lg:w-1/2 {{ $loop->even ? 'order-2' : ''  }}">--}}
{{--                        <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">--}}
{{--                            {{ $article->title }}</h1>--}}
{{--                        <p class="max-w-2xl mb-4 font-light text-gray-500 lg:mb-4 md:text-lg lg:text-xl dark:text-gray-400">{{ \Illuminate\Support\Str::limit($article->full_text, 150, $end='...') }}</p>--}}
{{--                        <p class="max-w-2xl mb-2 font-light text-gray-400 lg:mb-2 md:text-sm lg:text-sm dark:text-gray-500">Posted by: {{ $article->author->name }}</p>--}}
{{--                        <p class="max-w-2xl mb-2 font-light text-gray-400 lg:mb-2 md:text-sm lg:text-sm dark:text-gray-500">Posted at: {{ date('F-j, Y',strtotime($article->created_at)) }}</p>--}}
{{--                        <p class="max-w-2xl mb-2 font-light text-gray-400 lg:mb-2 md:text-sm lg:text-sm dark:text-gray-500">Category: {{ $article->category->name }}</p>--}}
{{--                        <p class="max-w-2xl mb-6 font-light text-gray-400 lg:mb-8 md:text-sm lg:text-sm dark:text-gray-500">Tags:--}}
{{--                            @foreach($article->tags as $tag)--}}
{{--                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-200">{{ $tag->name }}</span>--}}
{{--                            @endforeach--}}
{{--                        </p>--}}
{{--                        <a href="{{ route('article.show', $article->id) }}" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">--}}
{{--                            Read More--}}
{{--                            <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="hidden w-1/2 lg:mt-0 lg:flex {{ $loop->even ? 'order-1' : ''  }}">--}}
{{--                        <img src="{{ !empty($article->image) ? $article->image : asset('img/placeholder.png') }}" alt="image">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--            <div class="max-w-screen-xl px-4 py-8 mx-auto">--}}
{{--                <div class="my-4">{{ $articles->links() }}</div>--}}
{{--            </div>--}}
{{--        @endif--}}
    </section>
</x-guest-layout>
