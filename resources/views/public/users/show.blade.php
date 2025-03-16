<x-public-layout>
    <main class="pt-20 flex flex-col gap-3 items-center">
        <h1 class="text-3xl"><b>Bienvenido/a, {{ $user->name }} {{ $user->surname }}</b></h1>
        <div class="flex flex-col gap-20">
            <div class="flex flex-col gap-5">
                <p class="text-2xl">Tus datos:</p>
                <div class="text-xl">Nombre: <b>{{ $user->name }} {{ $user->surname }}</b></div>
                <div class="text-xl">Cliente desde: <b>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</b></div> {{-- fecha en formato dd-mm-yyyy y ignorando la hora --}}
                <div class="text-xl">Total de pedidos: <b>{{ $orderQuantity }}</b></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-gray-800 text-white py-2 px-4 rounded-full h-[40px] hover:bg-gray-600">Cerrar sesión</button>
                </form>
            </div>
            <div>
                <p class="text-2xl">Tus pedidos:</p>
                <div class="flex flex-col gap-3 mt-5">
                    @foreach ($orders as $order)
                        <div class="bg-white p-3 rounded-md">
                            <div>Fecha del pedido: <b>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') }}, {{ \Carbon\Carbon::parse($order->order_date)->format('H:i') }}</b></div>
                            <div>Precio final: <b>{{ $order->total_price }} €</b></div>
                            <div>Estado:
                                @if ($order->status == 'ordered')
                                    <div>Pendiente de revisión</div>
                                @endif
                                @if ($order->status == 'confirmed')
                                    <div>Pagado y recogido</div>
                                @endif
                                @if ($order->status == 'denied')
                                    <div>Denegado</div>
                                @endif
                            </div>
                            <div>
                                <a href="/order/{{ $order->id }}">
                                    <button class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3 hover:bg-gray-700">
                                        <span class="">Ver factura</span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</x-public-layout>