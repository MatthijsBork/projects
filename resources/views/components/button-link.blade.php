@props(['active'])

@php
    $classes = $active ?? false ? 'block px-4 py-2 transition rounded-md hover:bg-gray-300 bg-gray-200 hover:text-blue-600' : 'block px-4 py-2 transition bg-white rounded-md hover:bg-gray-300 hover:text-blue-600';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
