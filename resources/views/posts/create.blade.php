<x-layouts.layout>
    <x-slot name="title">
        Create a new post
    </x-slot>
    <div class="flex justify-center">
        <div class=" w-8/12 bg-white p-6 rounded-lg">
            <h1 class="text-lg font-bold flex justify-center pb-4">Publish a new post</h1>
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <x-form.input name="title" type="text" placeholder="Your title"/>

                <x-form.input name="thumbnail" type="file"/>

                <x-form.textarea name="excerpt" rows="2" placeholder="Your excerpt"/>

                <x-form.textarea name="body" rows="10" placeholder="Your body"/>

                <x-form.field class="flex justify-center">
                    <x-form.label name="category"/>
                    <select name="category_id" id="category_id"
                            class="bg-gray-100 border-2 w-1/2 p-4 rounded-lg @error('category') border-red-500 @enderror">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-form.error name="category"/>

                </x-form.field>
                <div class="flex justify-center">
                    <x-form.button>Post</x-form.button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.layout>
