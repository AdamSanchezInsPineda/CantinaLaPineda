@props([
    'type' => 'button',
    'variant' => 'default'
])

@php
    $variantClasses = [
        'default' => 'bg-primary text-primary-foreground hover:bg-primary/90',
        'outline' => 'border border-input bg-background hover:bg-accent hover:text-accent-foreground',
        'ghost' => 'hover:bg-accent hover:text-accent-foreground',
    ][$variant];
@endphp

<button 
    type="{{ $type }}" 
    {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 ' . $variantClasses]) }}
>
    {{ $slot }}
</button>

