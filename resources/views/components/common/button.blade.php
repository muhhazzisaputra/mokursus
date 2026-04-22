@props([
    'href' => '#',
    'variant' => 'primary',
    'size' => 'md'
])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'px-4 py-2 bg-blue-600 text-white rounded']) }}>
    {{ $slot }}
</a>