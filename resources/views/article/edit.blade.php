<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit article') }}
            </h2>
            <a class="lpb-btn" href="{{ route('article.index') }}">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('article.update', $article) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            @include('components.form-field', [
                                'name' => 'title',
                                'value' => old('title', $article->title),
                                'label' => 'Article Title',
                                'type' => 'text',
                                'placeholder' => 'Enter article title',
                                'required' => 'required',
                            ])
                        </div>

                        <div class="mb-6">
                            @include('components.form-field', [
                                'name' => 'full_text',
                                'value' => old('full_text', $article->full_text),
                                'label' => 'Article Full Text',
                                'type' => 'textarea',
                                'rows' => '10',
                                'placeholder' => 'Enter article full text',
                                'required' => 'required',
                            ])
                        </div>

                        <div class="mb-6">
                            <label for="category" class="lbp-label">Category</label>
                            <select name="category" id="category" class="lbp-input" required>
                                <option value="" @if (old('category', $article->category_id) == '') selected @endif>
                                    Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if (old('category', $article->category_id) === $category->id ) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('category'))
                                <div class="text-red-500 text-sm mt-2">{{ $errors->first('category') }}</div>
                            @endif
                        </div>

                        <div class="mb-6">
                            <label for="tom-select" class="lbp-label">Tags</label>
                            <select name="tags[]" id="tom-select" multiple="multiple" class="lbp-input" required>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ $article->tags->contains($tag) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('tags'))
                                <div class="text-red-500 text-sm mt-2">{{ $errors->first('tags') }}</div>
                            @endif
                        </div>

                        @if (!empty($article->image))
                            <div class="flex gap-4 items-center mb-6">
                                <div>
                                    <img class="w-40 h-auto" src="{{ asset($article->image) }}"
                                         alt="">
                                </div>

                                <div>
                                    <input type="checkbox" name="deleteImage" id="deleteImage" value="1">
                                    <label class="font-medium text-sm text-gray-700 dark:text-gray-300"
                                           for="deleteImage">Delete
                                        this image.</label>
                                </div>
                            </div>
                        @endif

                        <div class="mb-6">
                            <label for="image" class="lbp-label">Article Image (Optional)</label>
                            <input type="file" class="lbp-input" name="image" accept="image/*">
                        </div>

                        <button class="lbp-submit-btn mb-12" type="submit">Update Article</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
