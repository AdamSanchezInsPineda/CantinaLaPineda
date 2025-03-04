@props([
    'imageId',
    'imageSrc',
])

<div class="relative group border rounded-lg overflow-hidden" draggable="true" data-image-id="{{ $imageId }}">
    <img src="{{ $imageSrc }}" alt="Product image" class="w-full aspect-square object-cover">
    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
        <button type="button" class="text-white p-1.5 rounded-full bg-gray-900/60 hover:bg-gray-900" title="Drag to reorder">
            <i data-lucide="grip" class="w-4 h-4"></i>
        </button>
        <button type="button" class="text-white p-1.5 rounded-full bg-red-500/60 hover:bg-red-500" onclick="removeImage(this)" title="Remove image">
            <i data-lucide="trash-2" class="w-4 h-4"></i>
        </button>
    </div>
    <input type="hidden" name="image_order[]" value="{{ $imageId }}">
</div>

