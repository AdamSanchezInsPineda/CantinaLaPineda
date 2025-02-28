<x-admin-layout>
    <h1 class="flex items-center justify-center gap-3 text-2xl sm:text-4xl">
        <button id="toggle-btn" class="lg:hidden mt-3"><x-icons.hamburguer class="size-8"/></button>
        <div class="mt-3">Edita la configuración</div>
    </h1>
    <form action="{{ route('admin.preference.update', $preference->id) }}" method="post" class="flex items-center justify-center flex-col">
        @csrf
        @method('PUT')
        <label for="value" class="mt-10">Valor de la configuración:</label>
        <input type="text" name="value" id="value" value="{{ $preference->value }}">
        <button class="bg-black text-white py-2 px-4 rounded-md mt-5"><input type="submit" value="Guardar" class="cursor-pointer"></button>
    </form>
    <script src="{{ mix('resources/js/displayadminasideresponsive.js') }}" defer></script>
</x-admin-layout>