@props(['messages'])

@if ($messages)
<ul {{ $attributes->merge(['class' => 'block  text-sm font-medium text-red-700 dark:text-red-500']) }}>

    @foreach ((array) $messages as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>
@endif
