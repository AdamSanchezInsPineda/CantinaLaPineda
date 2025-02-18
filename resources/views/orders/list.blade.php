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

        <header class="flex justify-center items-center pt-10 border-b-2 mb-12">
            <b class="text-4xl mb-10">Pedidos:</b>
        </header>

        <main class="flex flex-col gap-20">
            <div>
                <b class="text-2xl ml-10">Pedidos pendientes:</b>
                @foreach($pendingOrders as $order)
                    <div class="border-b-2 flex items-center justify-between">
                        <div class="flex items-center gap-4 ml-6">
                            <div>
                                <b class="text-xl ml-5">{{ $order->total_price }} €</b>
                                <p class="text-lg ml-5">Pedido en {{ $order->order_date }}</p>
                                <p class="text-lg ml-5">Pedido por {{ $order->user->name }} {{ $order->user->surname }}</p>
                            </div>              
                        </div>
                        <div class="flex">
                            <button class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px] hover:bg-gray-700">Aceptar pedido</button>
                            <button class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px] hover:bg-gray-700">Denegar pedido</button>
                            <a href="{{ route('order.show', $order->id) }}" class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px] hover:bg-gray-700 flex flex-row gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                                <span>Mostrar información</span>
                            </a>
                        </div>
                    </div>
                    
                @endforeach
            </div>

            <div>
                <b class="text-2xl ml-10">Pedidos aceptados:</b>
                @foreach($confirmedOrders as $order)
                    <div class="border-b-2 flex items-center justify-between">
                        <div class="flex items-center gap-4 ml-6">
                            <div>
                                <b class="text-xl ml-5">{{ $order->total_price }} €</b>
                                <p class="text-lg ml-5">Pedido en {{ $order->order_date }}</p>
                                <p class="text-lg ml-5">Aceptado en {{ $order->confirmation_date }}</p>
                                <p class="text-lg ml-5">Pedido por {{ $order->user->name }} {{ $order->user->surname }}</p>
                            </div>              
                        </div>
                        <div class="flex">
                            <a href="{{ route('order.show', $order->id) }}" class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px] hover:bg-gray-700 flex flex-row gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                                <span>Mostrar información</span>
                            </a>
                        </div>
                    </div>
                    
                @endforeach
            </div>

            <div>
                <b class="text-2xl ml-10">Pedidos degenados:</b>
                @foreach($deniedOrders as $order)
                    <div class="border-b-2 flex items-center justify-between">
                        <div class="flex items-center gap-4 ml-6">
                            <div>
                                <b class="text-xl ml-5">{{ $order->total_price }} €</b>
                                <p class="text-lg ml-5">Pedido en {{ $order->order_date }}</p>
                                <p class="text-lg ml-5">Denegado en {{ $order->confirmation_date }}</p>
                                <p class="text-lg ml-5">Pedido por {{ $order->user->name }} {{ $order->user->surname }}</p>
                            </div>              
                        </div>
                        <div class="flex">
                            <a href="{{ route('order.show', $order->id) }}" class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px] hover:bg-gray-700 flex flex-row gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                                <span>Mostrar información</span>
                            </a>
                        </div>
                    </div>
                    
                @endforeach
            </div>

            <div>
                <b class="text-2xl ml-10">Historial de pedidos:</b>
                @foreach($allOrders as $order)
                    <div class="border-b-2 flex items-center justify-between">
                        <div class="flex items-center gap-4 ml-6">
                            <div>
                                <b class="text-xl ml-5">{{ $order->total_price }} €</b>
                                <p class="text-lg ml-5">Pedido en {{ $order->order_date }}</p>
                                <p class="text-lg ml-5">Pedido por {{ $order->user->name }} {{ $order->user->surname }}</p>
                            </div>              
                        </div>
                        <div class="flex">
                            <a href="{{ route('order.show', $order->id) }}" class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 h-[40px] hover:bg-gray-700 flex flex-row gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                                <span>Mostrar información</span>
                            </a>
                        </div>
                    </div>
                    
                @endforeach
            </div>

        </main>
    </div>
</x-app-layout>