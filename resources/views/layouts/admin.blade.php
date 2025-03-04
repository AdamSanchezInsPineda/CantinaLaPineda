<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://unpkg.com/lucide@latest"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased min-h-screen">
        <div class="flex min-h-screen">
            <x-admin-aside/>
            <main class="flex-1 overflow-y-auto">
                <div class="flex h-14 items-center gap-4 border-b bg-background px-4 lg:h-[60px] lg:px-6">
                    <div class="flex items-center gap-1 text-sm text-muted-foreground ml-12 lg:ml-0">
                        <a href="{{ route('admin.dashboard') }}" class="font-medium">
                            Admin
                        </a>
                        <i data-lucide="chevron-right" class="h-4 w-4"></i>
                        <span class="font-medium">{{ $pageTitle ?? 'Dashboard' }}</span>
                    </div>
                </div>
                <div class="p-4 lg:p-6">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
