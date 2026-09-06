@extends('layouts.app')

@section('title', 'FoodPass - Mi Perfil')

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
                    Miembro desde: {{ auth()->user()->created_at ? ucfirst(auth()->user()->created_at->translatedFormat('F Y')) : 'Reciente' }}
                </span>
            </div>
            @if(auth()->user()->fecha_renovacion_membresia)
            <p class="text-xs text-gray-500 font-medium">Renovación: {{ \Carbon\Carbon::parse(auth()->user()->fecha_renovacion_membresia)->format('d/m/Y') }}</p>
            @endif
        </div>
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