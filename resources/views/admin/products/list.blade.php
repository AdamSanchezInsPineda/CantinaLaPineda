<x-admin-layout>
    <div>

        <header class="flex justify-between items-center pt-10 border-b-2 mb-12">
            <div class="ml-10 flex gap-5">
                <button id="toggle-btn" class="lg:hidden"><x-icons.hamburguer class="size-8"/></button>
                <b class="text-2xl">Productos:</b>
            </div>
            <a href="product/create">
                <button class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3 hover:bg-gray-700">
                    <span class="hidden sm:block ">+ Crear producto</span>
                    <x-icons.create class="size-6 block sm:hidden"/>
                </button>
            </a>
        </header>

        <main class="flex flex-col gap-8">

            @foreach($products as $product)
                <div class="border-b-2 sm:flex sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4 ml-6">
                        @if ($product->images && !empty($product->images))
                            <img src="{{ asset('storage/' . $product->images[0]) }}" width="150">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-32">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        @endif
                        <div>
                            <b class="text-xl">{{ $product->name }}</b>
                            <p class="text-lg">{{ number_format($product->price, 2, '.', '') }} €</p>
                            <p class="text-sm">Categoria: {{ $product->category->name }}</p>
                            <p class="text-sm">Codigo del producto: {{ $product->code }}</p>
                        </div>              
                    </div>
                    <div class="flex items-center justify-center">
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px] hover:bg-gray-700">Editar</a>
                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Seguro que quieres cambiar el estado de este producto?')" class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3 h-[40px] hover:bg-gray-700">
                                {{ $product->active ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>                        
                    </div>
                </div>
            @endforeach

        </main>
    </div>
    <script src="{{ mix('resources/js/displayadminasideresponsive.js') }}" defer></script>
</x-admin-layout>