<x-admin-layout>
    <h1 class="flex items-center justify-center gap-3 text-2xl sm:text-4xl">
        <button id="toggle-btn" class="lg:hidden mt-3"><x-icons.hamburguer class="size-8"/></button>
        <div class="mt-3">Crea un nuevo producto:</div>
    </h1>
    <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data" class="flex items-center justify-center flex-col">
        @csrf

        <div class="flex items-center gap-10 md:gap-60 mt-10 flex-col md:flex-row">
            <div class="flex flex-col">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" placeholder="Producto interesante" maxlength="30">
            </div>
            <div class="flex flex-col">
                <label for="description">Descripción:</label>
                <input type="text" name="description" id="description" placeholder="Descripcion descriptiva" maxlength="300">
            </div>
        </div>

        <div class="flex items-center gap-10 md:gap-60 mt-10 flex-col md:flex-row">
            <div class="flex flex-col">
                <label for="price">Precio:</label>
                <input type="number"  name="price" id="price" step="0.01" placeholder="1.23">
            </div>
        </div>

        <div class="flex items-center gap-10 md:gap-60 mt-10 flex-col md:flex-row">
            <div>
                <label for="category_id">Categoria:</label>
                <select name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" data-name="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col ml-7">
                <label for="code">Codigo del producto:</label>
                <div class="flex justify-center items-center gap-1">
                    <div id="code_1">BO</div>
                    <input type="text" name="code" id="code" placeholder="123" class="w-[100px]">
                    <div id="code_2">-PR</div>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-10 md:gap-60 mt-10 flex-col md:flex-row">
            <div class="flex flex-col justify-center items-center gap-5">
                <label for="images">Subir imágenes:</label>
                <input type="file" name="images[]" multiple accept="image/*">
            </div>
        </div>
        <div class="flex items-center gap-10 md:gap-60 mt-10 flex-col md:flex-row">
            <div class="flex items-center gap-5">
                <label for="featured">Producto destacado?</label>
                <input type="checkbox" name="featured" id="featured" value="1">
            </div>
        </div>

        <button class="bg-black text-white py-2 px-4 rounded-md mt-5"><input type="submit" value="Guardar" class="cursor-pointer"></button>
    </form>
    <script src="{{ mix('resources/js/displayadminasideresponsive.js') }}" defer></script>
    <script src="{{ mix('resources/js/productcode.js') }}" defer></script>
</x-admin-layout>