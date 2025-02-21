<x-store-header :categories="$categories"></x-store-header>
<x-app-layout>

    <main class="flex items-center justify-center">
        <!-- MOSTRAR UN PRODUCTO: PC Y TABLET, PEQUEÑAS DIFERENCIAS EN EL DISEÑO ENTRE ELLOS -->
        <div class="hidden md:flex w-[90%] items-center justify-center gap-10 mt-40">
            <div class="flex flex-col gap-2">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTy7S0JruZGX6NJHRNy3XP60n62PnJWIR-4Iw&s" alt="" class="max-w-[100px] max-h-[100px] min-w-[100px] min-h-[100px] rounded-md">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTy7S0JruZGX6NJHRNy3XP60n62PnJWIR-4Iw&s" alt="" class="max-w-[100px] max-h-[100px] min-w-[100px] min-h-[100px] rounded-md">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTy7S0JruZGX6NJHRNy3XP60n62PnJWIR-4Iw&s" alt="" class="max-w-[100px] max-h-[100px] min-w-[100px] min-h-[100px] rounded-md">
            </div>
            <div class="w-[500px] h-[500px] flex items-center justify-center">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTy7S0JruZGX6NJHRNy3XP60n62PnJWIR-4Iw&s" alt="" class="lg:min-w-[500px] lg:min-h-[500px] md:min-h-[300px] md:min-w-[300px] rounded-md">
            </div>
            <div class="w-[500px] flex flex-col gap-2">
                <b class="text-3xl">{{ $product->name }}</b>
                <p class="text-xl">{{ $product->price }} €</p>
                <p class="text-l">Quedan {{ $product->stock }}!</p>
                <p class="break-words max-w-[500px] whitespace-pre-wrap text-sm text-gray-700">{{ $product->description }}</p>
                <a href="" class="mt-10 bg-gray-800 text-white py-2 px-4 rounded-full mr-5 mb-3 h-[40px] w-[200px] hover:bg-gray-700 flex items-center justify-center gap-3">
                    <span>Añadir al carrito</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>                           
                </a>
            </div>
        </div>

        <!-- MOSTRAR UN PRODUCTO: MOVIL -->
        <div class="md:hidden mt-40 flex flex-col gap-5">
            <div class="flex gap-2">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTy7S0JruZGX6NJHRNy3XP60n62PnJWIR-4Iw&s" alt="" class="min-w-[50px] min-h-[50px] max-w-[75px] max-h-[75px] rounded-md">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTy7S0JruZGX6NJHRNy3XP60n62PnJWIR-4Iw&s" alt="" class="min-w-[50px] min-h-[50px] max-w-[75px] max-h-[75px] rounded-md">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTy7S0JruZGX6NJHRNy3XP60n62PnJWIR-4Iw&s" alt="" class="min-w-[50px] min-h-[50px] max-w-[75px] max-h-[75px] rounded-md">
            </div>
            <div class="flex items-center justify-center">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTy7S0JruZGX6NJHRNy3XP60n62PnJWIR-4Iw&s" alt="" class="min-w-[300px] min-h-[300px] rounded-md">
            </div>
            <div class="w-[300px] flex flex-col gap-2">
                <b class="text-3xl">{{ $product->name }}</b>
                <p class="text-xl">{{ $product->price }} €</p>
                <p class="text-l">Quedan {{ $product->stock }}!</p>
                <p class="break-words max-w-[500px] whitespace-pre-wrap text-sm text-gray-700">{{ $product->description }}</p>
                <a href="" class="mt-10 mb-20 bg-gray-800 text-white py-2 px-4 rounded-full h-[40px] w-[200px] hover:bg-gray-700 flex items-center justify-center gap-3">
                    <span>Añadir al carrito</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>                           
                </a>
            </div>
        </div>
    </main>
    
</x-app-layout>
