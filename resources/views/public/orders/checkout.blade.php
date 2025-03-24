<x-public-layout>
  <div id="checkout-container" class="bg-white p-4">
    <div class="md:max-w-5xl max-w-xl mx-auto">
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 max-md:order-1">
          <h2 class="text-3xl font-bold text-slate-900">Haz una reserva</h2>
          <p class="text-slate-900 text-sm mt-4"> Reserva tu pedido.</p>

          <div class="flex flex-col  sm:flex-row justify-center mt-8 gap-3">
            <button id="order-button" type="button" class="w-40 py-3 text-[15px] font-medium bg-purple-500 text-white rounded-md hover:bg-purple-600 tracking-wide">Finalizar</button>
          </div>
        </div>

        <div class="bg-gray-100 p-6 rounded-md">
          <h2 id="checkout-total" class="text-3xl font-bold text-slate-900"></h2>

          <ul id="checkout-content" class="text-slate-900 font-medium mt-12 space-y-4">
            
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-public-layout>