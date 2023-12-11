<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('All articles') }}
            </h2>
            <a class="lpb-btn" href="{{ route('article.create') }}">Add new article</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full table-auto">
                        <tr>
                            <th class="border px-4 py-2">Id</th>
                            <th class="border px-4 py-2 text-left">Title</th>
{{--                            <th class="border px-4 py-2 text-left">Short Text</th>--}}
                            <th class="border px-4 py-2">Category</th>
                            <th class="border px-4 py-2">Tags</th>
                            <th class="border px-4 py-2">Image</th>
                            <th class="border px-4 py-2">Created at</th>
                            <th class="border px-4 py-2">Action</th>
                        </tr>

                        @foreach ($articles as $article)
                            <tr>
                                <td class="border px-4 py-2 text-center">{{ $article->id }}</td>
                                <td class="border px-4 py-2">{{ $article->title }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <span class="bg-green-100 text-green-800 text-md font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">{{ $article->category->name }}</span>
                                </td>
                                <td class="border px-4 py-2 text-left">
                                    @foreach($article->tags as $tag)
                                        <span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td class="border px-4 py-2">
                                    @if(!empty($article->image))
                                    <img class="w-full m-auto"
                                         src="{{ $article->image }}" alt="image">
                                    @else
                                        <p class="w-full text-center">No image</p>
                                    @endif
                                </td>
                                <td class="border px-4 py-2 text-center">{{ date('F-j, Y',strtotime($article->created_at)) }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex items-center justify-center">
                                        <a class="lpb-edit-btn mr-2" href="{{ route('article.edit',$article->id) }}">
                                            @include('components.icons.edit')
                                        </a>

                                        <form action="{{ route('article.destroy', $article->id) }}"
                                              method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Are you sure you want to delete this items?')"
                                                    type="submit"class="lpb-delete-btn"
                                                    type="submit">
                                                @include('components.icons.trash')
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="my-4">{{ $articles->links() }}</div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
