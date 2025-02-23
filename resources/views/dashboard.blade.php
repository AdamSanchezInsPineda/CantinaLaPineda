<x-admin-aside></x-admin-aside>
<x-app-layout>
    <!--<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    pe
                </div>
            </div>
        </div>
    </div>-->
    <div>

        <header class="flex justify-between items-center pt-10 border-b-2 mb-12">
            <b class="text-2xl ml-10">Productos:</b>
            <button class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3">+ Crear producto</button>
        </header>

        <main class="flex flex-col gap-8">

            <div class="border-b-2 flex items-center justify-between">
                <div class="flex items-center gap-4 ml-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-32">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <div>
                        <b class="text-xl">Producto 1</b>
                        <p class="text-lg">10,00€/u</p>
                        <p class="text-sm">Aqui va las primeras letras de la descripcion...</p>
                    </div>              
                </div>
                <div>
                    <button class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3">Editar</button>
                    <button class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3">Borrar</button>
                </div>
            </div>

            <div class="border-b-2 flex items-center justify-between">
                <div class="flex items-center gap-4 ml-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-32">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <div>
                        <b class="text-xl">Producto 2</b>
                        <p class="text-lg">5,00€/u</p>
                        <p class="text-sm">Aqui va las primeras letras de la descripcion...</p>
                    </div>              
                </div>
                <div>
                    <button class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3">Editar</button>
                    <button class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3">Borrar</button>
                </div>
            </div>

            <div class="border-b-2 flex items-center justify-between">
                <div class="flex items-center gap-4 ml-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-32">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <div>
                        <b class="text-xl">Producto 3</b>
                        <p class="text-lg">8,00€/u</p>
                        <p class="text-sm">Aqui va las primeras letras de la descripcion...</p>
                    </div>              
                </div>
                <div>
                    <button class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3">Editar</button>
                    <button class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3">Borrar</button>
                </div>
            </div>

            <div class="border-b-2 flex items-center justify-between">
                <div class="flex items-center gap-4 ml-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-32">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <div>
                        <b class="text-xl">Producto 4</b>
                        <p class="text-lg">2,00€/u</p>
                        <p class="text-sm">Aqui va las primeras letras de la descripcion...</p>
                    </div>              
                </div>
                <div>
                    <button class="bg-black text-white py-2 px-4 rounded-md mr-5 mb-3">Editar</button>
                    <button class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3">Borrar</button>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>
