<x-public-layout>

    <main class="flex items-center justify-center">
        <div id="products-container" class="w-[90%] flex flex-wrap items-center justify-center gap-10 mt-24">
            @foreach($products as $product)
                <a href="{{ route('product.show', $product->id) }}" data-product-name="{{ $product->name }}">
                    <div class="flex flex-col w-[320px] h-[400px]">
                        <div class="w-[310px] h-[320px] flex items-center justify-center">
                            <img src="{{ $product->images && !empty(json_decode($product->images)) ? asset('storage/' . $product->images[0]) : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTy7S0JruZGX6NJHRNy3XP60n62PnJWIR-4Iw&s"}}" alt="" class="max-w-[300px] max-h-[310px] min-w-[300px] min-h-[310px] rounded-md">
                        </div>
                        <div class="flex justify-between mt-5">
                            <div>
                                <p>{{ $product->name }}</p>
                                <b>{{ $product->price }} €</b>
                            </div>
                            <button id="product-{{ $product->id }}" class="bg-gray-800 text-white py-2 px-4 rounded-full mr-5 mb-3 h-[40px] hover:bg-gray-700 flex items-center justify-center gap-3">
                                <span>Añadir</span>
                                <x-icons.shopping-bag class="size-6"/>
                            </button>
                        </div>
                    </div>
                </a>     
            @endforeach  
        </div>        
    </main>
    <script src="{{ mix('resources/js/productfilter.js') }}" defer></script>
</x-public-layout>
