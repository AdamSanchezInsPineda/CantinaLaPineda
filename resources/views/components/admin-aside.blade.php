<aside class="hidden lg:block h-full w-full md:w-[300px] bg-white p-4 shadow-md border-r-2" id="admin-aside">
    <button id="hide-btn" class="mt-9 ml-6 lg:hidden"><x-icons.cancel class="size-8"/></button>
    <ul class="flex flex-col gap-12">
        <div class="mb-40"></div> <!-- esto no lo ha visto nadie... -->
        <a href="{{ route('admin.product.index') }}">
            <li class="rounded-md p-1 border-b-2 text-xl flex gap-4 items-center {{ request()->routeIs('admin.product.index') ? 'bg-gray-300' : 'hover:bg-gray-100' }}">
                <x-icons.product class="size-8"/>
                <span>Productos</span>
            </li>
        </a>
        <a href="{{ route('admin.order.index') }}">
            <li class="rounded-md p-1 border-b-2 text-xl flex gap-4 items-center {{ request()->routeIs('admin.order.index') ? 'bg-gray-300' : 'hover:bg-gray-100' }}">
                <x-icons.order class="size-8"/>
                <span>Pedidos</span>
            </li>
        </a>
        <a href="{{ route('admin.category.index') }}">
            <li class="rounded-md p-1 border-b-2 text-xl flex gap-4 items-center {{ request()->routeIs('admin.category.index') ? 'bg-gray-300' : 'hover:bg-gray-100' }}">
                <x-icons.category class="size-8"/>
                <span>Categorias</span>
            </li>
        </a>
        <a href="">
            <li class="rounded-md p-1 border-b-2 text-xl flex gap-4 items-center">
                <x-icons.user class="size-8"/>
                <span>Usuarios</span>
            </li>
        </a>
    </ul>
    <a href="{{ route('admin.preference.index') }}">
        <div class="ml-5 rounded-md p-1 border-b-2 text-xl flex gap-4 items-center {{ request()->routeIs('admin.preference.index') ? 'bg-gray-300' : 'hover:bg-gray-100' }} mt-auto fixed bottom-10 left-0">
            <x-icons.options class="size-8"/>
            <span>Configuraciones</span>
        </div>
    </a>
</aside>