<x-admin-layout>
    <x-slot:title>
        {{ isset($product) ? 'Edit Product' : 'Add Product' }}
    </x-slot>
    
    <div class="flex flex-col gap-4">
        <div class="flex items-center gap-4">
            <h1 class="text-lg font-semibold md:text-2xl">
                {{ isset($product) ? 'Edit Product' : 'Add Product' }}
            </h1>
        </div>
        @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 rounded-md p-4 mb-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-red-500"></i>
                </div>
                <div class="ml-3 w-full">
                    <h3 class="text-sm font-medium text-red-800">
                        Por favor corrige los siguientes errores:
                    </h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="grid gap-6">
            <form id="product-form" action="{{ isset($product) ? route('admin.product.update', $product->id) : route('admin.product.store') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
                @csrf
                @if(isset($product))
                    @method('PUT')
                @endif
                
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <x-form-input 
                        type="text" 
                        id="name" 
                        name="name" 
                        :value="$product->name ?? old('name')" 
                        label="Nombre"
                        placeholder="Nombre del producto"
                        required
                        :error="$errors->first('name')"
                    />
                    
                    <x-form-select 
                        id="category" 
                        name="category_id" 
                        label="Categoria"
                        required
                        :error="$errors->first('category')"
                    >
                        <option value="">Selecciona una categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ (isset($product) && $product->category == $category ) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </x-form-select>
                    
                    <x-form-input 
                        type="number" 
                        id="price" 
                        name="price" 
                        :value="$product->price ?? old('price')" 
                        step="0.01"
                        label="Precio"
                        required
                        :error="$errors->first('price')"
                    />
                    
                    <x-form-input 
                        type="text" 
                        id="code" 
                        name="code" 
                        :value="$product->code ?? old('code')" 
                        label="Codigo"
                        required
                        :error="$errors->first('code')"
                    />
                    
                    <x-form-select 
                        id="featured" 
                        name="featured" 
                        label="Destacado"
                        required
                        :error="$errors->first('status')"
                    >
                        <option value="1" {{ (isset($product) && $product->featured == true) ? 'selected' : '' }}>Activado</option>
                        <option value="0" {{ (isset($product) && $product->featured == false) ? 'selected' : '' }}>Desactivado</option>
                    </x-form-select>
                </div>
                
                <x-form-textarea 
                    id="description" 
                    name="description" 
                    label="Description"
                    placeholder="Describe el producto"
                    :error="$errors->first('description')"
                >{{ $product->description ?? old('description') }}</x-form-textarea>

                {{-- Product Images Section --}}
                <div class="space-y-4">
                    <div class="flex flex-col space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                            Product Images
                        </label>
                        <div class="flex items-center justify-center w-full">
                            <label for="images" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer hover:bg-muted/50">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i data-lucide="upload" class="w-8 h-8 mb-2 text-gray-500"></i>
                                    <p class="mb-2 text-sm text-gray-500">
                                        <span class="font-semibold">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG or WEBP (MAX. 800x400px)</p>
                                </div>
                                <input 
                                    id="images" 
                                    name="images[]" 
                                    type="file" 
                                    class="hidden" 
                                    accept="image/png,image/jpeg,image/webp" 
                                    multiple
                                >
                            </label>
                        </div>
                        @error('images')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Image Preview Grid --}}
                    <div id="image-preview-container" class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-6">
                        @if(isset($product) && $product->images)
                            @foreach($product->images as $image)
                            <div class="relative group border rounded-lg overflow-hidden" draggable="true" data-image-id="{{ $image->id }}">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="Product image" class="w-full aspect-square object-cover">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                    <button type="button" class="text-white p-1.5 rounded-full bg-gray-900/60 hover:bg-gray-900" title="Drag to reorder">
                                        <i data-lucide="grip" class="w-4 h-4"></i>
                                    </button>
                                    <button type="button" class="text-white p-1.5 rounded-full bg-red-500/60 hover:bg-red-500" onclick="removeImage(this)" title="Remove image">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                                <input type="hidden" name="image_order[]" value="{{ $image->id }}">
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                
                <div class="flex gap-4">
                    <button 
                        type="submit" 
                        class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2"
                    >
                        Save
                    </button>
                    <a 
                        href="{{ route('admin.product.index') }}" 
                        class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('product-form');
            const imageInput = document.getElementById('images');
            const previewContainer = document.getElementById('image-preview-container');
            let dragSrcEl = null;

            // Evento que pilla las imagenes
            imageInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                
                files.forEach(file => {
                    if (file.type.match('image.*')) {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const div = document.createElement('div');
                            div.className = 'relative group border rounded-lg overflow-hidden';
                            div.draggable = true;
                            // Les da una id temporal
                            div.dataset.newImage = 'true';
                            div.innerHTML = `
                                <img src="${e.target.result}" alt="Product image" class="w-full aspect-square object-cover">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                    <button type="button" class="text-white p-1.5 rounded-full bg-gray-900/60 hover:bg-gray-900" title="Drag to reorder">
                                        <i data-lucide="grip" class="w-4 h-4"></i>
                                    </button>
                                    <button type="button" class="text-white p-1.5 rounded-full bg-red-500/60 hover:bg-red-500" onclick="removeImage(this)" title="Remove image">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            `;
                            
                            previewContainer.appendChild(div);
                            lucide.createIcons();
                            initDragAndDrop(div);
                        };
                        
                        reader.readAsDataURL(file);
                    }
                });
            });

            // Funcionalidad drag and drop
            function initDragAndDrop(element) {
                element.addEventListener('dragstart', handleDragStart);
                element.addEventListener('dragover', handleDragOver);
                element.addEventListener('dragenter', handleDragEnter);
                element.addEventListener('dragleave', handleDragLeave);
                element.addEventListener('drop', handleDrop);
                element.addEventListener('dragend', handleDragEnd);
            }

            // Inicializando drag and drop para las imagenes existentes
            document.querySelectorAll('#image-preview-container > div').forEach(initDragAndDrop);

            window.handleDragStart = function(e) {
                dragSrcEl = e.target.closest('[draggable="true"]');
                e.target.closest('[draggable="true"]').classList.add('opacity-50');
                
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/html', dragSrcEl.innerHTML);
            }

            function handleDragOver(e) {
                if (e.preventDefault) {
                    e.preventDefault();
                }
                e.dataTransfer.dropEffect = 'move';
                return false;
            }

            function handleDragEnter(e) {
                this.classList.add('bg-accent');
            }

            function handleDragLeave(e) {
                this.classList.remove('bg-accent');
            }

            function handleDrop(e) {
                if (e.stopPropagation) {
                    e.stopPropagation();
                }

                if (dragSrcEl !== this) {
                    const allImages = [...previewContainer.children];
                    const draggedIndex = allImages.indexOf(dragSrcEl);
                    const droppedIndex = allImages.indexOf(this);

                    if (draggedIndex < droppedIndex) {
                        this.parentNode.insertBefore(dragSrcEl, this.nextSibling);
                    } else {
                        this.parentNode.insertBefore(dragSrcEl, this);
                    }
                }

                this.classList.remove('bg-accent');
                return false;
            }

            function handleDragEnd(e) {
                this.classList.remove('opacity-50');
                
                document.querySelectorAll('#image-preview-container > div').forEach(function(item) {
                    item.classList.remove('bg-accent');
                });
            }

            // Quitar imagen
            window.removeImage = function(button) {
                const imageContainer = button.closest('[draggable="true"]');
                imageContainer.remove();
            }

            // Validación de formulario
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const name = document.getElementById('name').value;
                const category = document.getElementById('category_id').value;
                const price = document.getElementById('price').value;
                
                let isValid = true;
                let errorMessages = [];
                
                if (!name) {
                    isValid = false;
                    errorMessages.push('Name is required');
                }
                
                if (!category) {
                    isValid = false;
                    errorMessages.push('Category is required');
                }
                
                if (!price || isNaN(parseFloat(price)) || parseFloat(price) < 0) {
                    isValid = false;
                    errorMessages.push('Price must be a valid positive number');
                }
                
                if (isValid) {
                    // Actualizar orden de las imagenes
                    const imageOrder = [];
                    document.querySelectorAll('#image-preview-container > div').forEach(function(div) {
                        const imageId = div.dataset.imageId;
                        if (imageId) {
                            imageOrder.push(imageId);
                        }
                    });

                    // Borrar orden existente
                    document.querySelectorAll('input[name="image_order[]"]').forEach(input => input.remove());

                    // Añadir nuevo orden
                    imageOrder.forEach(id => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'image_order[]';
                        input.value = id;
                        form.appendChild(input);
                    });

                    this.submit();
                } else {
                    alert('Please fix the following errors:\n' + errorMessages.join('\n'));
                }
            });

            // Zona de drag and drop
            const dropZone = document.querySelector('label[for="images"]');
            
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                dropZone.classList.add('bg-muted');
            }

            function unhighlight(e) {
                dropZone.classList.remove('bg-muted');
            }

            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                if (e.stopPropagation) {
                    e.stopPropagation();
                }

                if (dragSrcEl !== this) {
                    const allImages = [...previewContainer.children];
                    const draggedIndex = allImages.indexOf(dragSrcEl);
                    const droppedIndex = allImages.indexOf(this);

                    if (draggedIndex < droppedIndex) {
                        this.parentNode.insertBefore(dragSrcEl, this.nextSibling);
                    } else {
                        this.parentNode.insertBefore(dragSrcEl, this);
                    }
                    
                    // Actualiza el input al terminar
                    updateImageOrderInputs();
                }

                this.classList.remove('bg-accent');
                return false;
            }

            function updateImageOrderInputs() {
                // Quitar inputs existentes
                document.querySelectorAll('input[name="image_order[]"]').forEach(input => input.remove());
                
                // Crea nuevos inputs
                document.querySelectorAll('#image-preview-container > div').forEach(function(div, index) {
                    const imageId = div.dataset.imageId;
                    if (imageId) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'image_order[]';
                        input.value = imageId;
                        form.appendChild(input);
                    }
                });
            }
        });
    </script>
</x-admin-layout>