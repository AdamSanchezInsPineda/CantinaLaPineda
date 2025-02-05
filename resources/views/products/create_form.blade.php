<x-admin-aside></x-admin-aside>
<x-app-layout>
    <h1 class="flex items-center justify-center text-4xl">
        <div class="mt-3">Crea un nuevo producto:</div>
    </h1>
    <form action="{{ route('product.store') }}" method="post" class="flex items-center justify-center flex-col">
        @csrf

        <div class="flex items-center gap-60 mt-10">
            <div class="flex flex-col">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" placeholder="Producto interesante">
            </div>
            <div class="flex flex-col">
                <label for="description">Descripción:</label>
                <input type="text" name="description" id="description" placeholder="Descripcion descriptiva">
            </div>
        </div>

        <div class="flex items-center gap-60 mt-10">
            <div class="flex flex-col">
                <label for="stock">Stock:</label>
                <input type="number" name="stock" id="stock" placeholder="20">
            </div>
            <div class="flex flex-col">
                <label for="price">Precio:</label>
                <input type="number"  name="price" id="price" step="0.01" placeholder="1.23">
            </div>
        </div>

        <div class="flex items-center gap-60 mt-10">
            <div class="flex items-center gap-12">
                <label for="featured">Producto destacado?</label>
                <input type="checkbox" name="featured" id="featured">
            </div>
            <div class="flex flex-col ml-7">
                <label for="code">Codigo del producto:</label>
                <input type="text" name="code" id="code" placeholder="ca123-pr">
            </div>
        </div>

        <button class="bg-black text-white py-2 px-4 rounded-md mt-5"><input type="submit" value="Guardar" class="cursor-pointer"></button>
    </form>
</x-app-layout>