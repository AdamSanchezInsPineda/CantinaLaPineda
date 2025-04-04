<x-admin-layout>
    <div>

        <header class="flex justify-between items-center pt-10 border-b-2 mb-12">
            <div class="ml-10 flex gap-5">
                <button id="toggle-btn" class="lg:hidden"><x-icons.hamburguer class="size-8"/></button>
                <b class="text-2xl">Usuarios:</b>
            </div>
        </header>

        <main class="flex flex-col gap-8">
            <div class="mb-4 flex items-center justify-center">
                <input type="text" id="searchInput" placeholder="Busca tu usuario" class="px-4 py-2 border rounded-md w-[90%]">
            </div>

            @foreach($users as $user)
                <div class="user-item border-b-2 flex items-center justify-between">
                    <div class="flex items-center gap-4 ml-6">
                        <div class="">
                            <b class="text-xl">Nombre:<br> {{ $user->name }} {{ $user->surname }}</b>
                            <p class="text-l">Cliente desde:<br> {{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</p>
                        </div>              
                    </div>
                    <div class="flex">
                        @if ($user->role == "admin")
                            <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="add_admin" value="false">
                                <button type="submit" onclick="return confirm('¿Seguro que quieres quitar los permisos de administrador a este usuario?')" class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3 h-[40px] hover:bg-gray-700">Descender</button>
                            </form>                        
                        @else
                            <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="add_admin" value="true">
                                <button type="submit" onclick="return confirm('¿Seguro que quieres ascender a este usuario a administrador?')" class="bg-black text-white py-2 px-4 rounded-md mr-10 mb-3 h-[40px] hover:bg-gray-700">Ascender</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach

        </main>
    </div>
    <script src="{{ mix('resources/js/displayadminasideresponsive.js') }}" defer></script>
    <script src="{{ mix('resources/js/searchbar/usersearcher.js') }}" defer></script>
</x-admin-layout>