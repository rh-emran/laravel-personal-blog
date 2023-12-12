<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('All tags') }}
            </h2>
            <a class="lpb-btn" href="{{ route('tag.create') }}">Add new tag</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full table-auto">
                        <tr>
                            <th class="border px-4 py-2">Id</th>
                            <th class="border px-4 py-2 text-left">Name</th>
                            <th class="border px-4 py-2">Action</th>
                        </tr>

                        @foreach ($tags as $tag)
                            <tr>
                                <td class="border px-4 py-2 text-center">{{ $tag->id }}</td>
                                <td class="border px-4 py-2">{{ $tag->name }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex items-center justify-center">
                                        <a class="lpb-edit-btn mr-2" href="{{ route('tag.edit',$tag->id) }}">
                                            @include('components.icons.edit')
                                        </a>

                                        <form action="{{ route('tag.destroy', $tag) }}"
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
                    <div class="my-4">{{ $tags->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
