<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create new tag') }}
            </h2>
            <a class="lpb-btn" href="{{ route('tag.index') }}">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('tag.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            @include('components.form-field', [
                                'name' => 'name',
                                'value' => old('name'),
                                'label' => 'Tag Name',
                                'type' => 'text',
                                'placeholder' => 'Enter tag name',
                                'required' => 'required',
                            ])
                        </div>
                        <button class="lbp-submit-btn" type="submit">Save Tag</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
