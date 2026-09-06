<!-- SideNavBar Shell Reutilizable Oficial FoodPass -->
<aside class="flex flex-col z-40 h-screen w-64 fixed left-0 top-0 overflow-y-auto bg-[#273517] shadow-2xl font-['Plus_Jakarta_Sans',sans-serif] tracking-wide shrink-0">
    <div class="p-8">
        <h1 class="text-2xl font-bold text-white mb-1">FoodPass</h1>
        <p class="text-white/50 text-xs uppercase tracking-widest font-bold">The Artisanal Ledger</p>
    </div>

    <nav class="flex-1 px-4 space-y-2">
        <!-- 1. Inicio -->
        <a class="flex items-center gap-3 rounded-full px-4 py-3 mx-2 transition-all duration-200 {{ request()->routeIs('dashboard*') ? 'bg-[#F97F2D] text-white font-semibold shadow-lg shadow-[#F97F2D]/20 active:scale-95' : 'text-white/70 hover:text-white hover:bg-white/10 font-semibold' }}" href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined" @if(request()->routeIs('dashboard*')) style="font-variation-settings: 'FILL' 1;" @endif>home</span>
            <span class="text-sm">Inicio</span>
        </a>

        <!-- 2. Menú -->
        <a class="flex items-center gap-3 rounded-full px-4 py-3 mx-2 transition-all duration-200 {{ request()->routeIs('menu-digital*') ? 'bg-[#F97F2D] text-white font-semibold shadow-lg shadow-[#F97F2D]/20 active:scale-95' : 'text-white/70 hover:text-white hover:bg-white/10 font-semibold' }}" href="{{ route('menu-digital') }}">
            <span class="material-symbols-outlined" @if(request()->routeIs('menu-digital*')) style="font-variation-settings: 'FILL' 1;" @endif>restaurant_menu</span>
            <span class="text-sm">Menú</span>
        </a>

        <!-- 3. Historial -->
        <a class="flex items-center gap-3 rounded-full px-4 py-3 mx-2 transition-all duration-200 {{ request()->routeIs('historial*') ? 'bg-[#F97F2D] text-white font-semibold shadow-lg shadow-[#F97F2D]/20 active:scale-95' : 'text-white/70 hover:text-white hover:bg-white/10 font-semibold' }}" href="{{ route('historial') }}">
            <span class="material-symbols-outlined" @if(request()->routeIs('historial*')) style="font-variation-settings: 'FILL' 1;" @endif>history</span>
            <span class="text-sm">Historial</span>
        </a>

        <!-- 4. Canje -->
        <a class="flex items-center gap-3 rounded-full px-4 py-3 mx-2 transition-all duration-200 {{ request()->routeIs('canje*') ? 'bg-[#F97F2D] text-white font-semibold shadow-lg shadow-[#F97F2D]/20 active:scale-95' : 'text-white/70 hover:text-white hover:bg-white/10 font-semibold' }}" href="{{ route('canje') }}">
            <span class="material-symbols-outlined" @if(request()->routeIs('canje*')) style="font-variation-settings: 'FILL' 1;" @endif>qr_code_scanner</span>
            <span class="text-sm">Canje</span>
        </a>

        <!-- 5. Pagos -->
        <a class="flex items-center gap-3 rounded-full px-4 py-3 mx-2 transition-all duration-200 {{ request()->routeIs('metodos-pago*') ? 'bg-[#F97F2D] text-white font-semibold shadow-lg shadow-[#F97F2D]/20 active:scale-95' : 'text-white/70 hover:text-white hover:bg-white/10 font-semibold' }}" href="{{ route('metodos-pago') }}">
            <span class="material-symbols-outlined" @if(request()->routeIs('metodos-pago*')) style="font-variation-settings: 'FILL' 1;" @endif>payments</span>
            <span class="text-sm">Pagos</span>
        </a>

        <!-- 6. Perfil -->
        <a class="flex items-center gap-3 rounded-full px-4 py-3 mx-2 transition-all duration-200 {{ request()->routeIs('perfil*') ? 'bg-[#F97F2D] text-white font-semibold shadow-lg shadow-[#F97F2D]/20 active:scale-95' : 'text-white/70 hover:text-white hover:bg-white/10 font-semibold' }}" href="{{ route('perfil') }}">
            <span class="material-symbols-outlined" @if(request()->routeIs('perfil*')) style="font-variation-settings: 'FILL' 1;" @endif>person</span>
            <span class="text-sm">Perfil</span>
        </a>
    </nav>

    <!-- Usuario autenticado al pie -->
    <div class="mt-auto p-6 border-t border-white/5">
        <a href="{{ route('perfil') }}" class="flex items-center gap-3 px-2 py-3 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
            @if(auth()->check() && auth()->user()->foto_perfil)
                <img alt="User avatar" class="w-10 h-10 rounded-full object-cover border border-white/20 shrink-0" src="{{ asset('storage/' . auth()->user()->foto_perfil) }}"/>
            @else
                <div class="w-10 h-10 rounded-full bg-[#F97F2D] text-white flex items-center justify-center font-bold text-sm shadow-sm shrink-0">
                    {{ auth()->check() ? substr(auth()->user()->name, 0, 1) : 'U' }}
                </div>
            @endif
            <div class="overflow-hidden">
                <p class="text-white font-bold truncate text-sm">{{ auth()->check() ? auth()->user()->name : 'Usuario SENA' }}</p>
                <p class="text-white/40 text-xs truncate">Aprendiz SENA</p>
            </div>
        </a>
    </div>
</aside>