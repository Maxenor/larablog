@props(['category'])

<div class="space-x-2">
    <a href="?=categories={{ $category->name }}"
       class="px-3 py-1 border border-red-300 rounded-full text-red-300 text-xs uppercase font-semibold"
       style="font-size: 10px">{{ $category->name }}</a>
</div>
