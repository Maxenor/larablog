@props(['name', 'type' => 'text', 'placeholder' => ''])

<x-form.field>
    <x-form.label :name="$name"/>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}"
           class="bg-gray-100 border-2 w-full p-4 rounded-lg @error($name) border-red-500 @enderror"
           value="{{ old($name) }}">
    <x-form.error :name="$name"/>
</x-form.field>
