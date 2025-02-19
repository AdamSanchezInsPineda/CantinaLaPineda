<x-store-header :categories="$categories"></x-store-header>
<x-app-layout>

    <main class="flex items-center justify-center">
        <div class="w-[90%] flex flex-wrap items-center justify-center gap-10 mt-5">
            @foreach($products as $product)
                <a href="{{ route('product.show', $product->id) }}">
                    <div class="flex flex-col w-[320px] h-[400px]">
                        <div class="w-[310px] h-[320px] flex items-center justify-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTy7S0JruZGX6NJHRNy3XP60n62PnJWIR-4Iw&s" alt="" class="max-w-[300px] max-h-[310px] min-w-[300px] min-h-[310px] rounded-md">
                        </div>
                        <div class="flex justify-between mt-5">
                            <div>
                                <p>{{ $product->name }}</p>
                                <b>{{ $product->price }} €</b>
                            </div>
                            <a href="" class="bg-gray-800 text-white py-2 px-4 rounded-full mr-5 mb-3 h-[40px] hover:bg-gray-700 flex items-center justify-center gap-3">
                                <span>Añadir</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>                           
                            </a>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>        
    </main>
    
</x-app-layout>
