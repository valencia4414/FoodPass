<aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-[#273517] text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <div class="p-6">
        <h1 class="text-2xl font-bold">FoodPass</h1>
    </div>
    <nav class="mt-6 px-4 space-y-2">
        <!-- Enlaces descriptivos (RNF01) -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/10">
            <span class="material-symbols-outlined">home</span> Inicio
        </a>
        <a href="{{ route('menu-digital') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/10">
            <span class="material-symbols-outlined">restaurant</span> Menú
        </a>
        <a href="{{ route('historial') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/10">
            <span class="material-symbols-outlined">history</span> Historial
        </a>
    </nav>
</aside>

<!-- Fondo oscuro para cerrar el menú en móvil -->
<div id="overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>