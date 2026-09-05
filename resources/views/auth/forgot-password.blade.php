<!DOCTYPE html>
<html class="light" lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FoodPass - Recuperar Contraseña</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<style>
  .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
  body { font-family: 'Inter', sans-serif; }
  h1,h2,h3 { font-family: 'Plus Jakarta Sans', sans-serif; }
</style>
</head>
<body class="bg-[#f0ffd8] min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-md">
    <!-- Logo -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center gap-2 mb-2">
            <div class="w-10 h-10 bg-[#F97F2D] rounded-xl flex items-center justify-center text-white font-extrabold text-lg shadow-lg">F</div>
            <span class="text-2xl font-extrabold text-[#121f05]">FoodPass</span>
        </div>
        <p class="text-sm text-[#574237]">Recupera el acceso a tu cuenta</p>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
        <div class="mb-6 text-center">
            <span class="material-symbols-outlined text-[48px] text-[#F97F2D]">lock_reset</span>
            <h1 class="text-2xl font-extrabold text-[#121f05] mt-2">¿Olvidaste tu contraseña?</h1>
            <p class="text-sm text-gray-500 mt-1">Ingresa tu correo y te enviaremos un enlace para restablecerla.</p>
        </div>

        <!-- Toast de éxito -->
        @if(session('success'))
            <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 rounded-xl p-4 mb-5 text-sm">
                <span class="material-symbols-outlined text-[20px]">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <!-- Errores -->
        @if($errors->any())
            <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-5 text-sm">
                <span class="material-symbols-outlined text-[20px]">error</span>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="space-y-1 mb-6">
                <label for="email" class="block text-[11px] font-bold uppercase tracking-widest text-[#574237]">
                    Correo Electrónico
                </label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="usuario@foodpass.com"
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm px-4 py-3 focus:ring-2 focus:ring-[#F97F2D] focus:border-[#F97F2D] outline-none transition @error('email') border-red-500 @enderror"
                >
            </div>

            <button type="submit"
                class="w-full bg-[#F97F2D] hover:bg-[#e06d20] text-white font-bold text-sm py-3.5 rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-[#F97F2D]/20 transition-all">
                <span class="material-symbols-outlined text-[20px]">send</span>
                Enviar Enlace de Recuperación
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm text-[#574237] hover:text-[#F97F2D] transition-colors font-medium inline-flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Volver al inicio de sesión
            </a>
        </div>
    </div>
</div>

</body>
</html>
