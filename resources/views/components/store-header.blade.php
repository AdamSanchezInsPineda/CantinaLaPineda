<header class="fixed left-0 top-0 w-full bg-white ">
    <div class="flex flex-row justify-between mt-4">
        {{-- BARRA DE BUSQUEDA: GENERAL --}}
        <div class=" ml-5 flex flex-row justify-center items-center gap-10">
            <div class="flex flex-row items-center justify-center gap-3 mb-3">         
                <input type="text" name="name" id="search-input" placeholder="Busca tu producto" class="p-2 rounded-full">
                <x-icons.search class="size-6 transform translate-x-[-50px]"/>
            </div>
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
                <a href="" class="flex gap-3">
                    <x-icons.cart class="size-8 mb-4"/>
                    <span class="mt-1">Ver el carrito</span> 
                </a>
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
    <div id="cart" class="p-10">
        <h1 class="text-3xl font-bold">Carrito:</h1>
        <div id="cart-content"></div>
    </div>
</header>
<script src="{{ mix('resources/js/displaycategoriestablet.js') }}" defer></script>
<script src="{{ mix('resources/js/mobilemenu.js') }}" defer></script>