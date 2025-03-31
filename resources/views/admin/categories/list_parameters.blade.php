<x-admin-layout>
    <div>

        <header class="flex justify-between items-center pt-10 border-b-2 mb-12">
            <div class="ml-10 flex gap-5">
                <button id="toggle-btn" class="lg:hidden"><x-icons.hamburguer class="size-8"/></button>
                <b class="text-2xl">Configura tu categoria:</b>
            </div>
            <a href="{{ route('admin.category.parameters.create', $category->id) }}">
                <button class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3 hover:bg-gray-700">
                    <span class="hidden sm:block ">+ Crear nuevo parametro de configuracion</span>
                    <x-icons.create class="size-6 block sm:hidden"/>
                </button>
            </a>
        </header>

        <main class="flex flex-col gap-8">

            @foreach($category->category_parameters as $parameter)
                <div class="border-b-2 sm:flex sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4 ml-6">
                        <div>
                            <b class="text-xl ml-5">{{ $parameter->description }}</b>
                        </div>              
                    </div>
                    <div class="flex items-center justify-center ml-10">
                        <form action="{{ route('admin.category.parameters.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" onclick="return confirm('¿Seguro que quieres cambiar el estado de esta categoria?')" class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3 h-[40px] hover:bg-gray-700">
                                {{ $parameter->active ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>  
                    </div>
                </div>
            @endforeach

        </main>
    </div>
    <script src="{{ mix('resources/js/displayadminasideresponsive.js') }}" defer></script>
</x-admin-layout>