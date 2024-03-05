@props(['name', 'placeholder' => '', 'rows'])
<x-form.field>
    <x-form.label :name="$name"/>
    <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}"
              class="bg-gray-100 border-2 w-full p-4 rounded-lg @error($name) border-red-500 @enderror">{{ old($name) }}</textarea>
    <x-form.error :name="$name"/>
</x-form.field>


