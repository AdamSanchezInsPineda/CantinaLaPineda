@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'required' => false
])

<div class="space-y-2">
    <label 
        for="{{ $name }}" 
        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
    >
        {{ $label }}
    </label>
    <textarea 
        id="{{ $name }}" 
        name="{{ $name }}" 
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'flex min-h-[100px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50']) }}
    >{{ $value }}</textarea>
    @error($name)
        <p class="text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>

