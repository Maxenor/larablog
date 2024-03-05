@props([
    'post'
])

<x-panel>
    <form method="POST" action="/posts/{{ $post->slug }}/comments"
          class="flex flex-col">
        @csrf
        <header class="flex items-center">
            <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" width="40" height="40"
                 class="rounded-xl">
            <h2 class="ml-4">Want
                to participate?</h2>
        </header>
        <x-form.textarea name="body" rows="5" placeholder="Quick, think of something to say!"/>
        @auth
            <div class="flex justify-end">
                <x-form.button>Post</x-form.button>
            </div>
        @else
            <p class="font-semibold">
                <a href="/register" class="hover:underline">Register</a> or <a href="/login"
                                                                               class="hover:underline">
                    Log in</a> to leave a comment
            </p>
        @endauth
    </form>

</x-panel>
