<x-admin-aside></x-admin-aside>
<x-app-layout>
    <div class="ml-[300px]">

        <header class="flex justify-center items-center pt-10 border-b-2 mb-12">
            <b class="text-4xl mb-10">Detalles del pedido:</b>
        </header>

        <main class="flex flex-col gap-20">
            @foreach($order->products as $product)
                <div class="border-b-2 flex items-center justify-between">
                    <div class="flex items-center gap-4 ml-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-32">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <div>
                            <b class="text-xl">{{ $product->name }}</b>
                            <p class="text-lg">{{ number_format($product->price, 2, '.', '') }} €</p>
                            <p class="text-sm">{{ $product->stock }} uds</p>
                            <p class="text-sm">Categoria: {{ $product->category->name }}</p>
                        </div>              
                    </div>
                    <div class="flex">
                        <button class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px]">Cantidad: {{ $product->pivot->quantity }}</button>
                    </div>
                </div>
            @endforeach
            <div class="flex flex-col gap-8">
                <b class="flex justify-center align-center text-xl">Total del pedido: {{ $order->total_price }} €</b>
                <div class="flex justify-center align-center">
                    <button class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px] hover:bg-gray-700">Aceptar pedido</button>
                    <button class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px] hover:bg-gray-700">Denegar pedido</button>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>