<x-admin-layout>
    <div class="flex items-center pt-20 md:pt-40 justify-center gap-20 flex-col md:flex-row">
        <a href="{{ route("admin.product.index") }}" class="flex flex-col justify-center text-center">
            <x-icons.product class="size-20"/>
            <p>Productos</p>
        </a>

        <a href="{{ route("admin.order.index") }}" class="flex flex-col justify-center text-center">
            <x-icons.order class="size-20"/>
            <p>Pedidos</p>
        </a>

        <a href="{{ route("admin.category.index") }}" class="flex flex-col justify-center text-center">
            <x-icons.category class="size-20"/>
            <p>Categorias</p>
        </a>

        <a href="{{ route("admin.dashboard") }}" class="flex flex-col justify-center text-center">
            <x-icons.user class="size-20"/>
            <p>Usuarios</p>
        </a>
    </div>
</x-admin-layout>