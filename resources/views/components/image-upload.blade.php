@props([
    'label' => 'Product Images',
    'name' => 'images',
    'multiple' => true,
    'accept' => 'image/png,image/jpeg,image/webp'
])

<div class="space-y-4">
    <div class="flex flex-col space-y-2">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
            {{ $label }}
        </label>
        <div class="flex items-center justify-center w-full">
            <label for="{{ $name }}" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer hover:bg-muted/50">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <i data-lucide="upload" class="w-8 h-8 mb-2 text-gray-500"></i>
                    <p class="mb-2 text-sm text-gray-500">
                        <span class="font-semibold">Click to upload</span> or drag and drop
                    </p>
                    <p class="text-xs text-gray-500">PNG, JPG or WEBP (MAX. 800x400px)</p>
                </div>
                <input 
                    id="{{ $name }}" 
                    name="{{ $name }}{{ $multiple ? '[]' : '' }}" 
                    type="file" 
                    class="hidden" 
                    accept="{{ $accept }}"
                    {{ $multiple ? 'multiple' : '' }}
                >
            </label>
        </div>
        @error($name)
            <p class="text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>
    {{ $slot }}
</div>

