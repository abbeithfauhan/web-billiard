@props(['active'])
@php
$classes = ($active ?? false)
            ? 'block pl-4 pr-2 py-2 text-sm font-medium text-white bg-cyan-600'
            : 'block pl-4 pr-2 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-white';
@endphp
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>