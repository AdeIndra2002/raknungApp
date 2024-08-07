@props(['active'])

@if($active)
<span class="absolute inset-y-0 left-0 w-2 bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
@endif
<a {{ $attributes->merge(['class' => 'inline-flex items-center w-full text-sm font-semibold text-gray-700 hover:text-gray-500 dark:text-gray-400 dark:hover:text-gray-600 transition-colors duration-150 hover:text-gray-500']) }}>

    {{ $icon ?? '' }}
    <span class="ml-4 text-gray-700 hover:text-gray-500 dark:text-gray-400 dark:hover:text-gray-600">{{ $slot }}</span>

</a>
