<x-layouts.layout>
    <x-slot name="title">
        Create a new post
    </x-slot>
    <div class="flex justify-center">
        <div class=" w-8/12 bg-white p-6 rounded-lg">
            <h1 class="text-lg font-bold flex justify-center pb-4">Publish a new post</h1>
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="sr-only">Title</label>
                    <input type="text" name="title" id="title" placeholder="Your title"
                           class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror"
                           value="{{ old('title') }}">
                    @error('title')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="thumbnail" class="sr-only">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail"
                           class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('thumbnail') border-red-500 @enderror"
                           value="{{ old('thumbnail') }}">
                    @error('thumbnail')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="excerpt" class="sr-only">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" rows="2" placeholder="Your excerpt"
                              class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('excerpt') border-red-500 @enderror">{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" rows="10" placeholder="Your body"
                              class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror">{{ old('body') }}</textarea>
                    @error('body')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 flex justify-center">
                    <label for="category_id" class="sr-only">Category</label>
                    <select name="category_id" id="category_id"
                            class="bg-gray-100 border-2 w-1/2 p-4 rounded-lg @error('category') border-red-500 @enderror">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-1/2">Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.layout>
