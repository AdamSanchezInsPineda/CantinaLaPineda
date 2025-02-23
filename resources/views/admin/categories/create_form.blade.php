<x-admin-layout>
    <h1 class="flex items-center justify-center text-4xl">
        <div class="mt-3">Crea una nueva categoria</div>
    </h1>
    <form action="{{ route('admin.category.store') }}" method="post" class="flex items-center justify-center flex-col">
        @csrf
        <label for="name" class="mt-10">Nombre de la categoria:</label>
        <input type="text" name="name" id="name">
        <button class="bg-black text-white py-2 px-4 rounded-md mt-5"><input type="submit" value="Guardar" class="cursor-pointer"></button>
    </form>
</x-admin-layout>