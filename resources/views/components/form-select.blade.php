@props([
    'label' => '',
    'name' => '',
    'required' => false,
    'options' => []
])

<div class="space-y-2">
    <label 
        for="{{ $name }}" 
        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
    >
        {{ $label }}
    </label>
    <select 
        id="{{ $name }}" 
        name="{{ $name }}" 
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50']) }}
    >
        {{ $slot }}
    </select>
    @error($name)
        <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>

