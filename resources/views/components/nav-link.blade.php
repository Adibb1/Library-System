@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#6B705C] text-sm font-medium leading-5 text-gray-900 transition duration-150 ease-in-out hover:no-underline hover:text-gray-900 '
: 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:text-gray-900 hover:no-underline hover:border-gray-300 hover:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>