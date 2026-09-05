<header class="h-16 bg-white border-b flex items-center justify-between px-6">
    <!-- Botón Hamburguesa para móvil (RNF03) -->
    <button id="btn-menu" class="lg:hidden p-2 text-gray-600">
        <span class="material-symbols-outlined">menu</span>
    </button>




    <div class="flex items-center gap-5">
        <!-- Dropdown de Notificaciones -->
        <div class="relative x-dropdown">
            <button class="relative p-2 text-gray-500 hover:text-[#F97F2D] transition-colors rounded-full hover:bg-orange-50 focus:outline-none" onclick="document.getElementById('notif-menu').classList.toggle('hidden')">
                <span class="material-symbols-outlined text-[24px]">notifications</span>
                @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                @endif
            </button>
            <div id="notif-menu" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-gray-100 z-50 overflow-hidden">
                <div class="p-3 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Notificaciones</span>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="text-[10px] bg-[#F97F2D] text-white px-2 py-0.5 rounded-full">{{ auth()->user()->unreadNotifications->count() }} nuevas</span>
                    @endif
                </div>
                <div class="max-h-80 overflow-y-auto">
                    @forelse(auth()->user()->notifications as $notification)
                        <div class="p-4 border-b border-gray-50 hover:bg-gray-50 flex gap-3 transition-colors {{ empty($notification->read_at) ? 'bg-orange-50/30' : '' }}">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0 text-blue-600">
                                <span class="material-symbols-outlined text-[16px]">info</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-800">{{ $notification->data['message'] ?? 'Tienes una nueva actualización.' }}</p>
                                <span class="text-[10px] text-gray-400 mt-1 block">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-400">
                            <span class="material-symbols-outlined text-[32px] mb-2 opacity-50">notifications_off</span>
                            <p class="text-sm font-medium">No tienes notificaciones</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Dropdown de Usuario / Logout -->
        <div class="relative x-dropdown">
            <button class="flex items-center gap-3 focus:outline-none" onclick="document.getElementById('user-menu').classList.toggle('hidden')">
                <span class="text-sm font-medium hidden sm:block">{{ auth()->user()->name }}</span>
                @if(auth()->user()->foto_perfil)
                    <img src="{{ asset('storage/' . auth()->user()->foto_perfil) }}" class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm hover:border-[#F97F2D] transition-colors">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=273517&color=fff" class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm hover:border-[#F97F2D] transition-colors">
                @endif
            </button>
            <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 z-50 overflow-hidden py-2">
                <a href="{{ route('perfil') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-orange-50 hover:text-[#F97F2D] transition-colors">
                    <span class="material-symbols-outlined text-[18px]">person</span> Mi Perfil
                </a>
                <div class="h-px bg-gray-100 my-1"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">logout</span> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
    // Lógica para abrir/cerrar menú móvil (RNF03)
    const btnMenu = document.getElementById('btn-menu');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    if(btnMenu && sidebar && overlay) {
        btnMenu.onclick = () => { sidebar.classList.toggle('-translate-x-full'); overlay.classList.toggle('hidden'); };
        overlay.onclick = () => { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); };
    }

    // Cerrar dropdowns al hacer clic fuera
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.x-dropdown')) {
            const menus = [document.getElementById('notif-menu'), document.getElementById('user-menu')];
            menus.forEach(menu => {
                if (menu && !menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                }
            });
        }
    });
</script>