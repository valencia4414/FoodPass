<!DOCTYPE html>
<html class="light" lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FoodPass - Mi Perfil</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<style>
  .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
  body { font-family: 'Inter', sans-serif; }
  h1,h2,h3,h4,h5 { font-family: 'Plus Jakarta Sans', sans-serif; }
</style>
</head>
<body class="bg-[#f0ffd8] text-[#121f05] flex h-screen overflow-hidden">

<!-- ═══════════════ SIDEBAR (RNF06 - Reutilizable) ═══════════════ -->
<aside class="w-56 bg-[#273517] text-white flex flex-col shrink-0 h-full overflow-y-auto">
  <div class="px-6 pt-7 pb-5">
    <h1 class="text-lg font-bold text-white leading-tight">FoodPass</h1>
    <p class="text-white/40 text-[9px] uppercase tracking-widest font-bold mt-0.5">The Artisanal Ledger</p>
  </div>
  <nav class="flex-1 px-3 space-y-0.5">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-white/60 hover:text-white hover:bg-white/10 px-4 py-2.5 mx-1 rounded-full transition-all text-sm font-semibold">
      <span class="material-symbols-outlined text-[20px]">home</span>Inicio
    </a>
    <a href="{{ route('menu-digital') }}" class="flex items-center gap-3 text-white/60 hover:text-white hover:bg-white/10 px-4 py-2.5 mx-1 rounded-full transition-all text-sm font-semibold">
      <span class="material-symbols-outlined text-[20px]">restaurant_menu</span>Menú
    </a>
    <a href="{{ route('historial') }}" class="flex items-center gap-3 text-white/60 hover:text-white hover:bg-white/10 px-4 py-2.5 mx-1 rounded-full transition-all text-sm font-semibold">
      <span class="material-symbols-outlined text-[20px]">history</span>Historial
    </a>
    <!-- ACTIVO -->
    <a href="{{ route('perfil') }}" class="flex items-center gap-3 bg-[#F97F2D] text-white px-4 py-2.5 mx-1 rounded-full text-sm font-semibold">
      <span class="material-symbols-outlined text-[20px]" style="font-variation-settings:'FILL' 1">person</span>Perfil
    </a>
  </nav>
</aside>

<main class="flex-1 flex flex-col h-full overflow-hidden">
  <!-- Top Header -->
  <header class="h-14 bg-white/90 backdrop-blur-md border-b border-gray-100 flex items-center justify-between px-8 shrink-0 z-10">
    <span class="font-semibold text-sm">Mi Perfil</span>
    <div class="flex items-center gap-3">
        <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
        <div class="w-8 h-8 rounded-full bg-[#273517] flex items-center justify-center text-white font-bold text-sm">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
    </div>
  </header>

  <!-- Scrollable body -->
  <div class="flex-1 overflow-y-auto p-8">
    <div class="max-w-5xl mx-auto">

      <!-- ── HEADER PERFIL ── -->
      <div class="flex items-start gap-7 mb-10">
        <div class="relative shrink-0">
          <div class="w-28 h-28 rounded-2xl overflow-hidden shadow-md border-2 border-white bg-[#273517]">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=F97F2D&color=fff" class="w-full h-full object-cover" alt="Avatar"/>
          </div>
          <button class="absolute -bottom-2 -right-2 w-8 h-8 bg-[#F97F2D] rounded-full flex items-center justify-center text-white shadow-md border-2 border-[#f0ffd8]"><span class="material-symbols-outlined text-[15px]">photo_camera</span></button>
        </div>
        <div class="flex-1 pt-1">
          <h2 class="text-3xl font-extrabold text-[#121f05] mb-1">{{ auth()->user()->name }}</h2>
          <p class="text-[#574237] text-sm mb-5">{{ auth()->user()->email }}</p>
          <span class="bg-[#e2f4c8] text-[#006e16] text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">FRESHNESS GOLD</span>
        </div>
      </div>

      <!-- ── GRID CONTENIDO (RNF03 - Responsivo) ── -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- COLUMNA FORMULARIO (Punto 4: El Formulario Perfecto) -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-2xl p-7 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-[#121f05] mb-6">Editar Información Personal</h3>

            <!-- RNF05: Token CSRF -->
            <form action="{{ route('perfil.update') }}" method="POST" id="form-perfil">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Campo Nombre (RNF01) -->
                    <div class="space-y-1">
                        <label for="name" class="block text-[11px] font-bold uppercase tracking-widest text-[#574237]">Nombre Completo</label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" placeholder="Ej: Juan Pérez" 
                               class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-[#F97F2D] focus:border-[#F97F2D] @error('name') border-red-500 @enderror">
                        @error('name') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Campo Email (RNF01) -->
                    <div class="space-y-1">
                        <label for="email" class="block text-[11px] font-bold uppercase tracking-widest text-[#574237]">Correo Electrónico</label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" placeholder="usuario@foodpass.com" 
                               class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-[#F97F2D] focus:border-[#F97F2D] @error('email') border-red-500 @enderror">
                        @error('email') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Campo Contraseña (RNF01) -->
                    <div class="space-y-1 md:col-span-2">
                        <label for="password" class="block text-[11px] font-bold uppercase tracking-widest text-[#574237]">Nueva Contraseña (Opcional)</label>
                        <input type="password" name="password" id="password" placeholder="Mínimo 8 caracteres para cambiar" 
                               class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-[#F97F2D] focus:border-[#F97F2D] @error('password') border-red-500 @enderror">
                        @error('password') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Botón con Feedback (RNF07) -->
                <div class="mt-8">
                    <button type="submit" id="btn-save" class="w-full bg-[#F97F2D] text-white font-bold text-sm py-3.5 rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-[#F97F2D]/20 transition-all hover:bg-[#e06d20]">
                        <span id="btn-text">Guardar Cambios</span>
                        <div id="btn-spinner" class="hidden w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    </button>
                </div>
            </form>
          </div>
        </div>

        <!-- COLUMNA DERECHA (Puntos y Resumen) -->
        <div class="space-y-5">
          <div class="bg-[#273517] rounded-2xl p-6 text-white shadow-md">
            <span class="text-[10px] font-bold text-white/60 uppercase tracking-widest">PUNTOS ACUMULADOS</span>
            <p class="text-4xl font-extrabold mt-1">4,850 <span class="text-sm text-white/40">FP</span></p>
          </div>

          <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <span class="text-[10px] font-bold text-[#574237] uppercase tracking-widest">PEDIDOS TOTALES</span>
            <p class="text-4xl font-extrabold text-[#121f05] mt-1">128</p>
          </div>

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-white border border-gray-100 text-gray-500 font-bold text-xs py-3.5 rounded-xl hover:bg-red-50 hover:text-red-600 transition-colors">
              <span class="material-symbols-outlined text-[18px]">logout</span>Cerrar sesión
            </button>
          </form>
        </div>

      </div>
    </div>
  </div>
</main>

<!-- SCRIPT RNF07: Estado de carga -->
<script>
    document.getElementById('form-perfil').addEventListener('submit', function() {
        const btn = document.getElementById('btn-save');
        const text = document.getElementById('btn-text');
        const spinner = document.getElementById('btn-spinner');

        btn.disabled = true;
        btn.classList.add('opacity-70', 'cursor-not-allowed');
        text.innerText = 'Procesando...';
        spinner.classList.remove('hidden');
    });
</script>

</body>
</html>