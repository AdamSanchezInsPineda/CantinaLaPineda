<x-admin-layout>
    <div>

        <header class="flex justify-between items-center pt-10 border-b-2 mb-12">
            <div class="ml-10 flex gap-5">
                <button id="toggle-btn" class="lg:hidden"><x-icons.hamburguer class="size-8"/></button>
                <b class="text-2xl">Categorias:</b>
            </div>
            @if($categoryCount <= 6)
                <a href="category/create">
                    <button class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3 hover:bg-gray-700">
                        <span class="hidden sm:block ">+ Crear categoria</span>
                        <x-icons.create class="size-6 block sm:hidden"/>
                    </button>
                </a>
            @else
                <div class="bg-red-400 py-2 px-4 rounded-md mr-10 mb-3">maximo de categorias alcanzado</div>
            @endif
        </header>

        <main class="flex flex-col gap-8">

            @foreach($categories as $category)
                <div class="border-b-2 sm:flex sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4 ml-6">
                        <div>
                            <b class="text-xl ml-5">{{ $category->name }}</b>
                        </div>              
                    </div>
                    <div class="flex items-center justify-center ml-10">
                        <a href="{{ route('admin.category.parameters', $category->id) }}" class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px] hover:bg-gray-700">Configurar</a>
                        <a href="{{ route('admin.category.edit', $category->id) }}" class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px] hover:bg-gray-700">Editar</a>
                        <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Seguro que quieres borrar esta categoria?')" class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3 h-[40px] hover:bg-gray-700">Borrar</button>
                        </form>
                    </div>
                </div>
            @endforeach

        </main>
    </div>
    <script src="{{ mix('resources/js/displayadminasideresponsive.js') }}" defer></script>
</x-admin-layout>