@extends('layouts.app')

<<<<<<< HEAD
@section('title', 'FoodPass - Mi Perfil')
=======
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
    <a href="{{ route('canje') }}" class="flex items-center gap-3 text-white/60 hover:text-white hover:bg-white/10 px-4 py-2.5 mx-1 rounded-full transition-all text-sm font-semibold">
      <span class="material-symbols-outlined text-[20px]">redeem</span>Canje
    </a>
    <a href="{{ route('metodos-pago') }}" class="flex items-center gap-3 text-white/60 hover:text-white hover:bg-white/10 px-4 py-2.5 mx-1 rounded-full transition-all text-sm font-semibold">
      <span class="material-symbols-outlined text-[20px]">payments</span>Pagos
    </a>
    <!-- ACTIVO -->
    <a href="{{ route('perfil') }}" class="flex items-center gap-3 bg-[#F97F2D] text-white px-4 py-2.5 mx-1 rounded-full text-sm font-semibold">
      <span class="material-symbols-outlined text-[20px]" style="font-variation-settings:'FILL' 1">person</span>Perfil
    </a>
  </nav>
</aside>
>>>>>>> acab2ef7ff501e8ec4cc1a538a5222850f87a411

@section('content')
<div class="max-w-5xl mx-auto">

    <!-- ── HEADER PERFIL (RF06 y RF15) ── -->
    <div class="flex items-start gap-7 mb-10">
        <div class="relative shrink-0">
            <div class="w-28 h-28 rounded-2xl overflow-hidden shadow-md border-2 border-white bg-[#273517]">
                @if(auth()->user()->foto_perfil)
                    <img id="avatar-preview" src="{{ asset('storage/' . auth()->user()->foto_perfil) }}" class="w-full h-full object-cover" alt="Avatar"/>
                @else
                    <img id="avatar-preview" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=F97F2D&color=fff" class="w-full h-full object-cover" alt="Avatar"/>
                @endif
            </div>
            <!-- Botón para subir imagen (RF15) -->
            <button type="button" onclick="document.getElementById('foto_perfil').click()" class="absolute -bottom-2 -right-2 w-8 h-8 bg-[#F97F2D] rounded-full flex items-center justify-center text-white shadow-md border-2 border-[#f0ffd8] hover:bg-[#e06d20] transition-colors">
                <span class="material-symbols-outlined text-[15px]">photo_camera</span>
            </button>
        </div>
        <div class="flex-1 pt-1">
            <h2 class="text-3xl font-extrabold text-[#121f05] mb-1">{{ auth()->user()->name }}</h2>
            <p class="text-[#574237] text-sm mb-2">{{ auth()->user()->email }}</p>
            <div class="flex items-center gap-3 mb-2">
                <span class="bg-[#e2f4c8] text-[#006e16] text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    {{ auth()->user()->membresia ?? 'Básica' }}
                </span>
                <span class="text-xs text-gray-500 font-medium">
                    Miembro desde: {{ ucfirst(auth()->user()->created_at->translatedFormat('F Y')) }}
                </span>
            </div>
            @if(auth()->user()->fecha_renovacion_membresia)
            <p class="text-xs text-gray-500 font-medium">Renovación: {{ \Carbon\Carbon::parse(auth()->user()->fecha_renovacion_membresia)->format('d/m/Y') }}</p>
            @endif
        </div>
<<<<<<< HEAD
=======
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

          <a href="{{ route('privacidad') }}" class="block text-center text-xs font-semibold text-[#d85f18] hover:underline">Política de privacidad y derechos</a>
          <form method="POST" action="{{ route('cuenta.destroy') }}" onsubmit="return confirm('Esta acción eliminará tu cuenta y tus datos personales. ¿Deseas continuar?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full border border-red-200 bg-white py-3 text-xs font-bold text-red-600 rounded-xl hover:bg-red-50">Eliminar mi cuenta</button>
          </form>
        </div>

      </div>
>>>>>>> acab2ef7ff501e8ec4cc1a538a5222850f87a411
    </div>

    <!-- ── GRID CONTENIDO ── -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- COLUMNA FORMULARIO (RF15) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl p-7 shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-[#121f05] mb-6">Editar Información Personal</h3>

                <form action="{{ route('perfil.update') }}" method="POST" id="form-perfil" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Input oculto para la foto -->
                    <input type="file" name="foto_perfil" id="foto_perfil" class="hidden" accept="image/*" onchange="previewImage(event)">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Nombre -->
                        <div class="space-y-1">
                            <label for="name" class="block text-[11px] font-bold uppercase tracking-widest text-[#574237]">Nombre Completo</label>
                            <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" placeholder="Ej: Juan Pérez" 
                                   class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-[#F97F2D] focus:border-[#F97F2D] @error('name') border-red-500 @enderror">
                            <p id="error-name" class="text-red-500 text-[10px] mt-1 hidden">El nombre no puede estar vacío.</p>
                            @error('name') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-1">
                            <label for="email" class="block text-[11px] font-bold uppercase tracking-widest text-[#574237]">Correo Electrónico</label>
                            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" placeholder="usuario@foodpass.com" 
                                   class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-[#F97F2D] focus:border-[#F97F2D] @error('email') border-red-500 @enderror">
                            <p id="error-email" class="text-red-500 text-[10px] mt-1 hidden">Ingresa un correo válido.</p>
                            @error('email') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Teléfono (Nuevo RF15) -->
                        <div class="space-y-1">
                            <label for="telefono" class="block text-[11px] font-bold uppercase tracking-widest text-[#574237]">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', auth()->user()->telefono) }}" placeholder="+57 300 000 0000" 
                                   class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-[#F97F2D] focus:border-[#F97F2D]">
                        </div>

                        <!-- Idioma Preferido (Nuevo RF15) -->
                        <div class="space-y-1">
                            <label for="idioma_preferido" class="block text-[11px] font-bold uppercase tracking-widest text-[#574237]">Idioma Preferido</label>
                            <select name="idioma_preferido" id="idioma_preferido" class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-[#F97F2D] focus:border-[#F97F2D]">
                                <option value="es" {{ auth()->user()->idioma_preferido == 'es' ? 'selected' : '' }}>Español</option>
                                <option value="en" {{ auth()->user()->idioma_preferido == 'en' ? 'selected' : '' }}>English</option>
                            </select>
                        </div>

                        <!-- Dirección (Nuevo RF15) -->
                        <div class="space-y-1 md:col-span-2">
                            <label for="direccion" class="block text-[11px] font-bold uppercase tracking-widest text-[#574237]">Dirección</label>
                            <input type="text" name="direccion" id="direccion" value="{{ old('direccion', auth()->user()->direccion) }}" placeholder="Ej: Calle 123 #45-67" 
                                   class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-[#F97F2D] focus:border-[#F97F2D]">
                        </div>

                        <!-- Contraseña -->
                        <div class="space-y-1 md:col-span-2">
                            <label for="password" class="block text-[11px] font-bold uppercase tracking-widest text-[#574237]">Nueva Contraseña (Opcional)</label>
                            <input type="password" name="password" id="password" placeholder="Mínimo 8 caracteres para cambiar" 
                                   class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-[#F97F2D] focus:border-[#F97F2D] @error('password') border-red-500 @enderror">
                            @error('password') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" id="btn-save" class="w-full bg-[#F97F2D] text-white font-bold text-sm py-3.5 rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-[#F97F2D]/20 transition-all hover:bg-[#e06d20]">
                            <span id="btn-text">Guardar Cambios</span>
                            <div id="btn-spinner" class="hidden w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- COLUMNA DERECHA (Puntos y Resumen) (RF06) -->
        <div class="space-y-5">
            <div class="bg-[#273517] rounded-2xl p-6 text-white shadow-md">
                <span class="text-[10px] font-bold text-white/60 uppercase tracking-widest">PUNTOS ACUMULADOS</span>
                <p class="text-4xl font-extrabold mt-1">{{ number_format(auth()->user()->puntos_fp, 0) }} <span class="text-sm text-white/40">FP</span></p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <span class="text-[10px] font-bold text-[#574237] uppercase tracking-widest">PEDIDOS TOTALES</span>
                <p class="text-4xl font-extrabold text-[#121f05] mt-1">{{ auth()->user()->pedidos()->count() }}</p>
            </div>
            
            <!-- Botón Logout movido al header, pero si queremos dejarlo aquí también: -->
            <!-- Ya no es necesario aquí según RF08, pero lo dejamos si aporta valor o lo comentamos -->
        </div>

    </div>
</div>

<!-- Lógica del Perfil (RF15 Validación visual y Preview de Imagen) -->
<script>
    // Preview de Imagen
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Validación visual antes de submit
    document.getElementById('form-perfil').addEventListener('submit', function(e) {
        let hasErrors = false;
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        
        const errorName = document.getElementById('error-name');
        const errorEmail = document.getElementById('error-email');

        // Reset
        nameInput.classList.remove('border-red-500');
        emailInput.classList.remove('border-red-500');
        errorName.classList.add('hidden');
        errorEmail.classList.add('hidden');

        if(nameInput.value.trim() === '') {
            nameInput.classList.add('border-red-500');
            errorName.classList.remove('hidden');
            hasErrors = true;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailRegex.test(emailInput.value.trim())) {
            emailInput.classList.add('border-red-500');
            errorEmail.classList.remove('hidden');
            hasErrors = true;
        }

        if(hasErrors) {
            e.preventDefault(); // Detener el envío si hay errores visuales
            return;
        }

        // Estado de carga si no hay errores
        const btn = document.getElementById('btn-save');
        const text = document.getElementById('btn-text');
        const spinner = document.getElementById('btn-spinner');

        btn.disabled = true;
        btn.classList.add('opacity-70', 'cursor-not-allowed');
        text.innerText = 'Procesando...';
        spinner.classList.remove('hidden');
    });
</script>
@endsection