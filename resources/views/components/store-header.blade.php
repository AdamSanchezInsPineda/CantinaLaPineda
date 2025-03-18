<header class="w-full bg-white z-10">
    <div class="flex flex-row justify-between mt-4">
        {{-- BARRA DE BUSQUEDA: GENERAL --}}
        <div class=" ml-5 flex flex-row justify-center items-center gap-10">
            @if (request()->is('/') || strpos(request()->path(), 'category') !== false) {{-- si la url esta en / o contiene /category --}}
            <div class="flex flex-row items-center justify-center gap-3 mb-3">         
                <input type="text" name="name" id="search-input" placeholder="Busca tu producto" class="p-2 rounded-full" title="buscar productos">
                <x-icons.search class="size-6 transform translate-x-[-50px]"/>
            </div>
            @else
            <div class="flex flex-row items-center justify-center gap-3 mb-3">
                <a href="/" class="border-b-2 border-gray-500 mr-[155px] p-2">
                    volver al inicio
                </a>
            </div>
            @endif
        </div>

        {{-- LISTADO DE CATEGORIAS: PC --}}
        <div class="hidden lg:flex flex-row justify-center items-center gap-10 mb-4">
            <a href="{{ route('product.index') }}" class="text-xl"><b>Destacados</b></a>
            @foreach($categories as $category)
                <a href="{{ route('category.show', ['category_name' => $category->slug]) }}" class="text-xl">{{ $category->name }}</a>
            @endforeach        
        </div>

        {{-- DESPLEGABLE DE CATEGORIAS: TABLET --}}
        <button id="toggle-btn" class="hidden md:flex lg:hidden items-center justify-center gap-2 mb-4">
            <span class="font-bold text-xl">Categorias</span>
            <x-icons.arrow-down class="size-6"/>
        </button>
        <div id="category-box" class="hidden fixed top-10 left-1/2 transform -translate-x-1/2 bg-gray-200 p-4 mt-10 rounded-md z-50 min-w-[250px]">
            <div class="flex flex-col gap-8">
                <a href="{{ route('product.index') }}" class="text-xl"><b>Destacados</b></a>
                @foreach($categories as $category)
                    <a href="{{ route('category.show', ['category_name' => $category->slug]) }}" class="text-xl">{{ $category->name }}</a>
                @endforeach      
            </div>
        </div>

        {{-- CARRITO Y USUARIO: TABLET Y PC --}}
        <div class="hidden md:flex flex-row justify-center items-center gap-10 mr-5 ml-36">
            <button id="cart-button" title="Botón de carrito">
                <x-icons.cart class="size-8 mb-4"/>
            </button>
            <a href="{{ route('user.show', optional(Auth::user())->id ?? 0) }}" title="Botón de perfil de usuario"> {{-- envia el id del usuario, y si no existe envia un 0 para control de errores en en controlador --}}
                <x-icons.profile class="size-8 mb-4"/>
            </a>
        </div>
        
        {{-- MENU GENERAL: MOVIL --}}
        <button id="toggle-btn-2" class="md:hidden mb-4 mr-5" title="Botón para abrir el menú de navegación">
            <x-icons.hamburguer class="size-8"/>
        </button>
        <div id="mobile-menu" class="hidden fixed top-10 left-1/2 transform -translate-x-1/2 bg-gray-200 p-4 mt-10 rounded-md z-50 w-full">
            <div class="flex flex-col gap-8">
                <button id="cart-button-mb" href="" class="flex gap-3">
                    <x-icons.cart class="size-8 mb-4"/>
                    <span class="mt-1">Ver el carrito</span> 
                </button>
                <a href="{{ route('user.show', optional(Auth::user())->id ?? 0) }}" class="flex gap-3">
                    <x-icons.profile class="size-8 mb-4"/>
                    <span class="mt-1">Tu perfil</span>
                </a>
                <a href="{{ route('product.index') }}" class="text-xl"><b>Destacados</b></a>
                @foreach($categories as $category)
                    <a href="{{ route('category.show', ['category_name' => $category->slug]) }}" class="text-xl">{{ $category->name }}</a>
                @endforeach     
            </div>
        </div>
    </div>
</header>
<div id="cart-container" class="w-full h-screen fixed left-0 top-16 bg-black bg-opacity-50 hidden z-0">
    <div id="cart" class="bg-white p-10 transform -translate-y-full transition-transform duration-300 opacity-0 pointer-events-none">
        <h1 class="text-3xl font-bold">Carrito:</h1>
        <div id="cart-content"></div>
    </div>
</div>