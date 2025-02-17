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
            <b class="text-2xl ml-10">Pedidos:</b>
        </header>

        <main class="flex flex-col gap-8">

            @foreach($orders as $order)
                <div class="border-b-2 flex items-center justify-between">
                    <div class="flex items-center gap-4 ml-6">
                        <div>
                            <b class="text-xl ml-5">{{ $order->total_price }} €</b>
                            <p class="text-lg ml-5">{{ $order->order_date }}</p>
                            <p class="text-lg ml-5">Pedido por {{ $order->user->name }} {{ $order->user->surname }}</p>
                        </div>              
                    </div>
                    <div class="flex">
                        <button class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px] hover:bg-gray-700">Aceptar pedido</button>
                        <button class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px] hover:bg-gray-700">Denegar pedido</button>
                    </div>
                </div>
                
            @endforeach

        </main>
    </div>
</x-app-layout>