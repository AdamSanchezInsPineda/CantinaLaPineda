{{-- ASIDE PARA PC --}}
<aside class="hidden lg:flex w-64 shrink-0 border-r bg-background">
    <div class="flex w-full flex-col gap-4">
        <div class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 font-semibold">
                <i data-lucide="box" class="h-6 w-6"></i>
                <span>Admin Panel</span>
            </a>
        </div>
        <div class="flex-1 overflow-auto">
            <nav class="grid gap-1 px-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground {{ request()->routeIs('admin.dashboard') ? 'bg-accent' : 'transparent' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.product.index') }}" 
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground {{ request()->routeIs('admin.products.*') ? 'bg-accent' : 'transparent' }}">
                    <i data-lucide="box" class="w-5 h-5"></i>
                    Productos
                </a>
                <a href="{{ route('admin.category.index') }}" 
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground {{ request()->routeIs('admin.categories.*') ? 'bg-accent' : 'transparent' }}">
                    <i data-lucide="folder-tree" class="w-5 h-5"></i>
                    Categorias
                </a>
                <a href="{{ route('admin.order.index') }}" 
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground {{ request()->routeIs('admin.orders.*') ? 'bg-accent' : 'transparent' }}">
                    <i data-lucide="circle-dollar-sign" class="w-5 h-5"></i>
                    Pedidos
                </a>
                <a href="{{ route('admin.user.index') }}" 
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground {{ request()->routeIs('admin.users.*') ? 'bg-accent' : 'transparent' }}">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    Usuarios
                </a>
                <a href="" 
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground {{ request()->routeIs('admin.analytics') ? 'bg-accent' : 'transparent' }}">
                    <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                    Analíticas
                </a>
                <a href="{{ route('admin.preference.index') }}" 
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground {{ request()->routeIs('admin.settings') ? 'bg-accent' : 'transparent' }}">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                    Ajustes
                </a>
            </nav>
        </div>
        <div class="p-4 border-t">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-red-500 hover:bg-red-50">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- TOGGLE PARA MOVIL --}}
<div class="lg:hidden fixed top-0 left-0 z-40 p-2">
    <button id="sidebar-toggle" class="flex items-center justify-center w-10 h-10 rounded-md bg-backgroud shadow-md">
        <i data-lucide="menu" class="h-6 w-6"></i>
    </button>
</div>

{{-- SIDEBAR DE MOVIL --}}
<div id="mobile-sidebar" class="fixed inset-0 z-50 bg-background/80 backdrop-blur-sm transform -translate-x-full transition-transform duration-300 lg:hidden">
    <div class="fixed inset-y-0 left-0 z-50 w-[80%] max-w-sm bg-white shadow-lg opacity-95">
        <div class="flex h-14 items-center border-b px-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 font-semibold">
                <i data-lucide="box" class="h-6 w-6"></i>
                <span>Admin Panel</span>
            </a>
            <button id="sidebar-close" class="ml-auto">
                <i data-lucide="x" class="h-6 w-6"></i>
            </button>
        </div>
        <div class="overflow-y-auto h-[calc(100vh-3.5rem)]">
            <nav class="grid gap-1 px-2 py-4">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground {{ request()->routeIs('admin.dashboard') ? 'bg-accent' : 'transparent' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.product.index') }}" 
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground {{ request()->routeIs('admin.product.*') ? 'bg-accent' : 'transparent' }}">
                    <i data-lucide="box" class="w-5 h-5"></i>
                    Productos
                </a>
                <a href="{{ route('admin.category.index') }}" 
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground {{ request()->routeIs('admin.category.*') ? 'bg-accent' : 'transparent' }}">
                    <i data-lucide="folder-tree" class="w-5 h-5"></i>
                    Categorias
                </a>
                <a href="{{ route('admin.order.index') }}" 
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground {{ request()->routeIs('admin.order.*') ? 'bg-accent' : 'transparent' }}">
                    <i data-lucide="circle-dollar-sign" class="w-5 h-5"></i>
                    Pedidos
                </a>
                <a href="{{ route('admin.user.index') }}" 
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground {{ request()->routeIs('admin.user.*') ? 'bg-accent' : 'transparent' }}">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    Usuarios
                </a>
                <a href="" 
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground {{ request()->routeIs('admin.analytics') ? 'bg-accent' : 'transparent' }}">
                    <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                    Analíticas
                </a>
                <a href="{{ route('admin.preference.index') }}" 
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground {{ request()->routeIs('admin.settings') ? 'bg-accent' : 'transparent' }}">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                    Ajustes
                </a>
                <form class="flex gap-3 rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent hover:text-accent-foreground" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-red-500 hover:bg-red-50">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        Cerrar Sesión
                    </button>
                </form>
            </nav>
        </div>
    </div>
</div>