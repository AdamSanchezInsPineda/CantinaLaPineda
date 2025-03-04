<x-admin-layout>
    <div>

        <header class="flex justify-center items-center gap-5 pt-10 border-b-2 mb-12">
            <button id="toggle-btn" class="lg:hidden mb-10"><x-icons.hamburguer class="size-8"/></button>
            <b class="text-4xl mb-10">Pedidos:</b>
        </header>

        <main class="flex flex-col gap-20">
            <div>
                <b class="text-2xl ml-10">Pedidos pendientes:</b>
                @foreach($pendingOrders as $order)
                    <div class="border-b-2 sm:flex sm:items-center sm:justify-between">
                        <div class="flex items-center gap-4 ml-6">
                            <div>
                                <b class="text-xl ml-5">{{ $order->total_price }} €</b>
                                <p class="text-lg ml-5">Pedido en {{ $order->order_date }}</p>
                                <p class="text-lg ml-5">Pedido por {{ $order->user->name }} {{ $order->user->surname }}</p>
                            </div>              
                        </div>
                        <div class="flex items-center justify-center">
                            <button class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 xl:h-[40px] hover:bg-gray-700">
                                <span class="hidden sm:block">Aceptar pedido</span>
                                <x-icons.accept class="size-6 block sm:hidden"/>
                            </button>
                            <button class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 xl:h-[40px] hover:bg-gray-700">
                                <span class="hidden sm:block">Denegar pedido</span>
                                <x-icons.cancel class="size-6 block sm:hidden"/>
                            </button>
                            <a href="{{ route('admin.order.show', $order->id) }}" class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 xl:h-[40px] hover:bg-gray-700 flex flex-row gap-2">
                                <span class="hidden sm:block">Mostrar información</span>
                                <x-icons.info class="size-6 block sm:hidden"/>
                            </a>
                        </div>
                    </div>
                    
                @endforeach
            </div>

            <div>
                <b class="text-2xl ml-10">Pedidos aceptados:</b>
                @foreach($confirmedOrders as $order)
                    <div class="border-b-2 sm:flex sm:items-center sm:justify-between">
                        <div class="flex items-center gap-4 ml-6">
                            <div>
                                <b class="text-xl ml-5">{{ $order->total_price }} €</b>
                                <p class="text-lg ml-5">Pedido en {{ $order->order_date }}</p>
                                <p class="text-lg ml-5">Aceptado en {{ $order->confirmation_date }}</p>
                                <p class="text-lg ml-5">Pedido por {{ $order->user->name }} {{ $order->user->surname }}</p>
                            </div>              
                        </div>
                        <div class="flex items-center justify-center">
                            <a href="{{ route('admin.order.show', $order->id) }}" class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 xl:h-[40px] hover:bg-gray-700 flex flex-row gap-2">
                                <x-icons.info class="size-6 block sm:hidden"/>
                                <span class="block">Mostrar información</span>
                            </a>
                        </div>
                    </div>
                    
                @endforeach
            </div>

            <div>
                <b class="text-2xl ml-10">Pedidos degenados:</b>
                @foreach($deniedOrders as $order)
                    <div class="border-b-2 sm:flex sm:items-center sm:justify-between">
                        <div class="flex items-center gap-4 ml-6">
                            <div>
                                <b class="text-xl ml-5">{{ $order->total_price }} €</b>
                                <p class="text-lg ml-5">Pedido en {{ $order->order_date }}</p>
                                <p class="text-lg ml-5">Denegado en {{ $order->confirmation_date }}</p>
                                <p class="text-lg ml-5">Pedido por {{ $order->user->name }} {{ $order->user->surname }}</p>
                            </div>              
                        </div>
                        <div class="flex items-center justify-center">
                            <a href="{{ route('admin.order.show', $order->id) }}" class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 xl:h-[40px] hover:bg-gray-700 flex flex-row gap-2">
                                <x-icons.info class="size-6 block sm:hidden"/>
                                <span class="block">Mostrar información</span>
                            </a>
                        </div>
                    </div>
                    
                @endforeach
            </div>

            <div>
                <b class="text-2xl ml-10">Historial de pedidos:</b>
                @foreach($allOrders as $order)
                    <div class="border-b-2 sm:flex sm:items-center sm:justify-between">
                        <div class="flex items-center gap-4 ml-6">
                            <div>
                                <b class="text-xl ml-5">{{ $order->total_price }} €</b>
                                <p class="text-lg ml-5">Pedido en {{ $order->order_date }}</p>
                                <p class="text-lg ml-5">Pedido por {{ $order->user->name }} {{ $order->user->surname }}</p>
                            </div>              
                        </div>
                        <div class="flex items-center justify-center">
                            <a href="{{ route('admin.order.show', $order->id) }}" class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3 xl:h-[40px] hover:bg-gray-700 flex flex-row gap-2">
                                <x-icons.info class="size-6 block sm:hidden"/>
                                <span class="block">Mostrar información</span>
                            </a>
                        </div>
                    </div>
                    
                @endforeach
            </div>

        </main>
    </div>
    <script src="{{ mix('resources/js/displayadminasideresponsive.js') }}" defer></script>
</x-admin-layout>