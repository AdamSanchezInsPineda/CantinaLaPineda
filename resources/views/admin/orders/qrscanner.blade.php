<x-admin-layout>
    <div>
        <main class="flex flex-col gap-20">
            <div class="flex items-center justify-center flex-col gap-5">
                <h1 class="text-3xl font-bold">Escanea tu QR</h1>
                <div id="reader" style="width:300px;"></div>
            </div>
        </main>
    </div>
    <script src="{{ mix('resources/js/displayadminasideresponsive.js') }}" defer></script>
    <script type="module" src="{{ mix('resources/js/qrreader.js') }}" defer></script>
</x-admin-layout>