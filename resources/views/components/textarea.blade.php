@props(['value' => '', 'rows' => 4])

<textarea
    {{ $attributes->merge([
        'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'
    ]) }}
    rows="{{ $rows }}"
>{{ old($attributes->get('name'), $value) }}</textarea>
