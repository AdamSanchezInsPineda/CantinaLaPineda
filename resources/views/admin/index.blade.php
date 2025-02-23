<x-admin-layout>
    <div class="flex p-48 justify-around">
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