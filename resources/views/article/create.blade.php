<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create new article') }}
            </h2>
            <a class="lpb-btn" href="{{ route('article.index') }}">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            @include('components.form-field', [
                                'name' => 'title',
                                'value' => old('title'),
                                'label' => 'Article Title',
                                'type' => 'text',
                                'placeholder' => 'Enter article title',
                                'required' => '',
                            ])
                        </div>

                        <div class="mb-6">
                            @include('components.form-field', [
                                'name' => 'full_text',
                                'value' => old('full_text'),
                                'label' => 'Article Full Text',
                                'type' => 'textarea',
                                'rows' => '10',
                                'placeholder' => 'Enter article full text',
                                'required' => '',
                            ])
                        </div>

                        <div class="mb-6">
                            <label for="category" class="lbp-label">Category</label>
                            <select name="category" id="category" class="lbp-input" required>
                                <option value="" @if (old('category') == '') selected @endif>
                                    Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if (old('category') === $category->id ) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="select-tags" class="lbp-label">Tags</label>
                            <select name="tags[]" id="select-tags" multiple="multiple" class="lbp-input" required>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" @if (old('tags') === $tag->id ) selected @endif>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="image" class="lbp-label">Article Image (Optional)</label>
                            <input type="file" class="lbp-input" name="image" accept="image/*">
                        </div>

                        <button class="lbp-submit-btn" type="submit">Save Article</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    var settings = {
        plugins: ['remove_button'],
        create: true,
        onItemAdd:function(){
            this.setTextboxValue('');
            this.refreshOptions();
        },
    };
    new TomSelect('#select-tags',settings);

    // new TomSelect("#select-tags",{
    //     plugins: ['remove_button'],
    //     create: true,
    //     onItemAdd:function(){
    //         this.setTextboxValue('');
    //         this.refreshOptions();
    //     },
    //     render:{
    //         option:function(data,escape){
    //             return '<div class="d-flex"><span>' + escape(data.value) + '</span><span class="ms-auto text-muted">' + escape(data.date) + '</span></div>';
    //         },
    //         item:function(data,escape){
    //             return '<div>' + escape(data.value) + '</div>';
    //         }
    //     }
    // });

</script>
