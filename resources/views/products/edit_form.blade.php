<x-admin-aside></x-admin-aside>
<x-app-layout>
    <h1 class="flex items-center justify-center text-4xl">
        <div class="mt-3">Editar producto {{ $product->name }}:</div>
    </h1>
    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data" class="flex items-center justify-center flex-col">
        @csrf
        @method('PUT')

        <div class="flex items-center gap-60 mt-10">
            <div class="flex flex-col">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" placeholder="Producto interesante" value="{{ $product->name }}">
            </div>
            <div class="flex flex-col">
                <label for="description">Descripción:</label>
                <input type="text" name="description" id="description" placeholder="Descripcion descriptiva" value="{{ $product->description }}">
            </div>
        </div>

        <div class="flex items-center gap-60 mt-10">
            <div class="flex flex-col">
                <label for="stock">Stock:</label>
                <input type="number" name="stock" id="stock" placeholder="20" value="{{ $product->stock }}">
            </div>
            <div class="flex flex-col">
                <label for="price">Precio:</label>
                <input type="number"  name="price" id="price" step="0.01" placeholder="1.23" value="{{ number_format($product->price, 2, '.', '') }}">
            </div>
        </div>

        <div class="flex items-center gap-60 mt-10">
            <div>
                <label for="category_id">Categoria:</label>
                <select name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : ""}}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col ml-7">
                <label for="code">Codigo del producto:</label>
                <input type="text" name="code" id="code" placeholder="ca123-pr" value="{{ $product->code }}">
            </div>
        </div>
        <div class="flex items-center gap-60 mt-10">
            <div class="flex items-center gap-5">
                <label for="featured">Producto destacado?</label>
                <input type="checkbox" name="featured" id="featured" value="1" {{ $product->featured ? 'checked' : '' }}>
            </div>
        </div>
        <div>
            <div>
                <label for="images">Subir imágenes:</label>
                <input type="file" name="images[]" multiple accept="image/*">
            </div>
        </div>

        <button class="bg-black text-white py-2 px-4 rounded-md mt-5"><input type="submit" value="Guardar" class="cursor-pointer"></button>
    </form>
</x-app-layout>