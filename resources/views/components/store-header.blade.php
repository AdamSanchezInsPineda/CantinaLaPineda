<header class="w-full bg-white z-10">
    <div class="flex flex-row justify-between mt-4">
        {{-- BARRA DE BUSQUEDA: GENERAL --}}
        <div class=" ml-5 flex flex-row justify-center items-center gap-10">
            @if (request()->is('/') || strpos(request()->path(), 'category') !== false) {{-- si la url esta en / o contiene /category --}}
            <div class="flex flex-row items-center justify-center gap-3 mb-3">         
                <input type="text" name="name" id="search-input" placeholder="Busca tu producto" class="p-2 rounded-full">
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
            <button id="cart-button">
                <x-icons.cart class="size-8 mb-4"/>
            </button>
            <a href="{{ route('user.show', optional(Auth::user())->id ?? 0) }}"> {{-- envia el id del usuario, y si no existe envia un 0 para control de errores en en controlador --}}
                <x-icons.profile class="size-8 mb-4"/>
            </a>
        </div>
        
        {{-- MENU GENERAL: MOVIL --}}
        <button id="toggle-btn-2" class="md:hidden mb-4 mr-5">
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

<div id="cart-container" class="w-full h-screen fixed left-0 top-16 bg-black bg-opacity-50 hidden z-50">
    <div id="cart" class="bg-white p-6 transform -translate-y-full transition-transform duration-300 opacity-0 pointer-events-none max-w-3xl mx-auto rounded-lg shadow-xl overflow-y-auto max-h-[80vh]">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h1 class="text-2xl font-bold">Tu Carrito</h1>
            <button id="close-cart-button" class="text-gray-500 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div id="cart-content" class="divide-y"></div>
        
        <div id="cart-summary" class="mt-6 pt-4 border-t">
            <div class="flex justify-between font-bold text-lg mb-4">
                <span>Total:</span>
                <span id="cart-total">0.00€</span>
            </div>
            <div class="flex justify-between">
                <button id="empty-cart" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                    Vaciar carrito
                </button>
                <a href="/checkout" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Proceder al pago
                </a>
            </div>
        </div>
        
        <div id="empty-cart-message" class="hidden py-10 text-center">
            <p class="text-gray-500 mb-4">Tu carrito está vacío</p>
            <a href="/" class="text-blue-600 hover:underline">Continuar comprando</a>
        </div>
    </div>
</div>