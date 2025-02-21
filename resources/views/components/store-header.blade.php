<header class="fixed left-0 top-0 w-full bg-white h-[75px]">
    <div class="flex flex-row justify-between mt-4">
        <!-- BARRA DE BUSQUEDA: GENERAL -->
        <div class=" ml-5 flex flex-row justify-center items-center gap-10">
            <div class="flex flex-row items-center justify-center gap-3 mb-3">         
                <input type="text" name="name" id="search-input" placeholder="Busca tu producto" class="p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 transform translate-x-[-50px]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>   
            </div>
        </div>

        <!-- LISTADO DE CATEGORIAS: PC -->
        <div class="hidden lg:flex flex-row justify-center items-center gap-10 mb-4">
            <a href="{{ route('product.index') }}" class="text-xl"><b>Destacados</b></a>
            @foreach($categories as $category)
                <a href="{{ route('product.index', ['category' => $category->id]) }}" class="text-xl">{{ $category->name }}</a>
            @endforeach        
        </div>

        <!-- DESPLEGABLE DE CATEGORIAS: TABLET -->
        <button id="toggle-btn" class="hidden md:flex lg:hidden items-center justify-center gap-2 mb-4">
            <span class="font-bold text-xl">Categorias</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
            </svg>          
        </button>
        <div id="category-box" class="hidden fixed top-10 left-1/2 transform -translate-x-1/2 bg-gray-200 p-4 mt-10 rounded-md z-50 min-w-[250px]">
            <div class="flex flex-col gap-8">
                <a href="{{ route('product.index') }}" class="text-xl"><b>Destacados</b></a>
                @foreach($categories as $category)
                    <a href="{{ route('product.index', ['category' => $category->id]) }}" class="text-xl">{{ $category->name }}</a>
                @endforeach      
            </div>
        </div>

        <!-- CARRITO Y USUARIO: TABLET Y PC -->
        <div class="hidden md:flex flex-row justify-center items-center gap-10 mr-5 ml-36">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 mb-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>          
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 mb-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        </div>  
        
        <!-- MENU GENERAL: MOVIL -->
        <button id="toggle-btn-2" class="md:hidden mb-4 mr-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
            </svg>          
        </button>
        <div id="mobile-menu" class="hidden fixed top-10 left-1/2 transform -translate-x-1/2 bg-gray-200 p-4 mt-10 rounded-md z-50 w-full">
            <div class="flex flex-col gap-8">
                <a href="" class="flex gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                    <span class="mt-1">Ver el carrito</span> 
                </a>
                <a href="" class="flex gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span class="mt-1">Tu perfil</span>
                </a>
                <a href="{{ route('product.index') }}" class="text-xl"><b>Destacados</b></a>
                @foreach($categories as $category)
                    <a href="{{ route('product.index', ['category' => $category->id]) }}" class="text-xl">{{ $category->name }}</a>
                @endforeach     
            </div>
        </div>
    </div>
</header>
<script src="{{ mix('resources/js/displaycategoriestablet.js') }}" defer></script>
<script src="{{ mix('resources/js/mobilemenu.js') }}" defer></script>