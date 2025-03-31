<x-app-layout>
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl my-8">
        <div class="p-8">
            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Finalización de pago</div>
            <h2 class="mt-2 text-xl font-bold text-gray-900">Complete su reserva</h2>
            
            <div class="mt-4 text-gray-600">
                <p class="text-sm">Por favor, seleccione su método de pago preferido para completar la transacción.</p>
            </div>
            
            <div class="mt-6 flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                <form action="{{ route("order.update") }}" method="POST" data-turbo="false">
                    @csrf
                    <input type="hidden" name="order_id" required value="{{ $order->id }}"><br><br>
            
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-violet-500 hover:bg-violet-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        Reservar
                    </button>
                </form>

                <form action="{{ url('/bizum/pay') }}" method="POST" data-turbo="false">
                    @csrf
                    <input type="hidden" name="order_id" required value="{{ $order->id }}"><br><br>
            
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Pagar con Bizum
                    </button>
                </form>
            </div>
            
            <div class="mt-6 text-xs text-gray-500">
                <p>Al completar esta transacción, acepta nuestros términos y condiciones.</p>
            </div>
        </div>
    </div>
</x-app-layout>