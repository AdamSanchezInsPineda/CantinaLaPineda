<x-admin-aside></x-admin-aside>
<x-app-layout>
    <!--<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    pe
                </div>
            </div>
        </div>
    </div>-->
    <div class="ml-[300px]">

        <header class="flex justify-between items-center pt-10 border-b-2 mb-12">
            <b class="text-2xl ml-10">Categorias:</b>
            <a href="category/create"><button class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3 hover:bg-gray-700">+ Crear categoria</button></a>
        </header>

        <main class="flex flex-col gap-8">

            @foreach($categories as $category)
                <div class="border-b-2 flex items-center justify-between">
                    <div class="flex items-center gap-4 ml-6">
                        <div>
                            <b class="text-xl ml-5">{{ $category->name }}</b>
                        </div>              
                    </div>
                    <div class="flex">
                        <a href="{{ route('category.edit', $category->id) }}" class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px] hover:bg-gray-700">Editar</a>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Seguro que quieres borrar esta categoria?')" class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3 h-[40px] hover:bg-gray-700">Borrar</button>
                        </form>
                    </div>
                </div>
            @endforeach

        </main>
    </div>
</x-app-layout>