<x-admin-layout>
    <!--<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    pe
                </div>
            </div>
        </div>
    </div>-->
    <div class="ml-[300px]">

        <header class="flex justify-between items-center pt-10 border-b-2 mb-12">
            <b class="text-2xl ml-10">Configuraciones:</b>
        </header>

        <main class="flex flex-col gap-8">

            @foreach($preferences as $preference)
                <div class="border-b-2 flex items-center justify-between">
                    <div class="flex items-center ml-6 w-full justify-between">
                        <p class="text-xl">{{ $preference->description }}:</p>
                        <div class="flex gap-3 mr-10">
                            <b class="text-xl">{{ $preference->value }}</b>     
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>  
                            </a>                            
                        </div>     
                    </div>                    
                </div>
            @endforeach

        </main>
    </div>
</x-admin-layout>