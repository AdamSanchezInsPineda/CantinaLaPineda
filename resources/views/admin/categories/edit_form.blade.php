<x-admin-aside></x-admin-aside>
<x-app-layout>
    <h1 class="flex items-center justify-center text-4xl">
        <div class="mt-3">Crea una nueva categoria</div>
    </h1>
    <form action="{{ route('admin.category.update', $category->id) }}" method="post" class="flex items-center justify-center flex-col">
        @csrf
        @method('PUT')
        <label for="name" class="mt-10">Nombre de la categoria:</label>
        <input type="text" name="name" id="name" value="{{ $category->name }}">
        <button class="bg-black text-white py-2 px-4 rounded-md mt-5"><input type="submit" value="Guardar" class="cursor-pointer"></button>
    </form>
</x-app-layout>