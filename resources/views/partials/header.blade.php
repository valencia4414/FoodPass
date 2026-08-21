Html
<header class="h-16 bg-white border-b flex items-center justify-between px-6">
    <!-- Botón Hamburguesa para móvil (RNF03) -->
    <button id="btn-menu" class="lg:hidden p-2 text-gray-600">
        <span class="material-symbols-outlined">menu</span>
    </button>

    <div class="hidden md:block">
        <input type="text" placeholder="Buscar platillos..." class="bg-gray-100 rounded-full px-4 py-2 text-sm outline-none">
    </div>

    <div class="flex items-center gap-3">
        <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" class="w-8 h-8 rounded-full">
    </div>
</header>

<script>
    // Lógica para abrir/cerrar menú (RNF03)
    const btnMenu = document.getElementById('btn-menu');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    btnMenu.onclick = () => { sidebar.classList.toggle('-translate-x-full'); overlay.classList.toggle('hidden'); };
    overlay.onclick = () => { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); };
</script>