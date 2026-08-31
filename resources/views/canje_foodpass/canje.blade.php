<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canje - FoodPass</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Agregamos SweetAlert2 para el punto 20 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        fp: {
                            dark: '#273517',
                            light: '#f0ffd8',
                            qr: '#e8facd',
                            orange: '#f97316',
                            orangeHover: '#ea580c'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-fp-light font-sans text-slate-800 antialiased flex h-screen overflow-hidden">

    @php
        $user = auth()->user();
        // RF14: Verificar si ya canjeó hoy para el bloqueo
        $yaCanjeoHoy = \App\Models\Canje::where('user_id', $user->id)
                        ->whereDate('created_at', today())
                        ->exists();
        $esBeneficiario = $user->es_beneficiario_sena;
    @endphp

    <!-- Sidebar -->
    <aside class="w-56 bg-fp-dark flex flex-col justify-between flex-shrink-0">
        <div>
            <div class="p-6">
                <h1 class="text-white text-2xl font-bold tracking-tight">FoodPass</h1>
                <p class="text-white/50 text-xs font-semibold tracking-widest mt-1">ARTISANAL LEDGER</p>
            </div>
            
            <nav class="mt-4 px-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-white/70 hover:bg-white/10 rounded-xl transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="font-medium text-sm">Inicio</span>
                </a>
                <a href="{{ route('menu-digital') }}" class="flex items-center px-4 py-3 text-white/70 hover:bg-white/10 rounded-xl transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    <span class="font-medium text-sm">Menú</span>
                </a>
                <a href="{{ route('historial') }}" class="flex items-center px-4 py-3 text-white/70 hover:bg-white/10 rounded-xl transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium text-sm">Historial</span>
                </a>
                <a href="{{ route('canje') }}" class="flex items-center px-4 py-3 bg-fp-orange text-white rounded-xl shadow-lg shadow-orange-500/20 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                    <span class="font-medium text-sm">Canje</span>
                </a>
                <a href="{{ route('metodos-pago') }}" class="flex items-center px-4 py-3 text-white/70 hover:bg-white/10 rounded-xl transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    <span class="font-medium text-sm">Pagos</span>
                </a>
                <a href="{{ route('perfil') }}" class="flex items-center px-4 py-3 text-white/70 hover:bg-white/10 rounded-xl transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span class="font-medium text-sm">Perfil</span>
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-white/10">
            <div class="flex items-center">
                <div class="w-8 h-8 rounded-full bg-fp-orange text-white flex items-center justify-center font-bold text-sm shadow-sm">
                    {{ substr($user->name ?? 'U', 0, 1) }}
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-white">{{ $user->name ?? 'Usuario' }}</p>
                    <p class="text-xs text-white/50">v2.4.0</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="h-14 bg-white border-b border-gray-100 flex items-center justify-between px-6 flex-shrink-0 z-10">
            <div class="flex items-center w-96 relative">
                <svg class="w-5 h-5 text-gray-400 absolute left-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" placeholder="Buscar restaurantes..." class="w-full bg-gray-50 text-sm rounded-full pl-10 pr-4 py-2 border-none focus:ring-2 focus:ring-fp-orange/20 outline-none transition-all placeholder-gray-400">
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="flex items-center gap-2 cursor-pointer">
                    <span class="text-sm font-semibold text-gray-700 hidden sm:block">{{ $user->name }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f97316&color=fff" alt="Avatar" class="w-8 h-8 rounded-full border border-gray-100 shadow-sm">
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-6 lg:p-10 relative">
            <div class="max-w-6xl mx-auto">
                <div class="mb-10">
                    <h1 class="text-3xl lg:text-4xl font-extrabold text-fp-dark tracking-tight mb-3">Canje de Beneficios</h1>
                    <p class="text-gray-600 max-w-2xl text-lg leading-relaxed">Redime tu apoyo alimentario SENA de forma inmediata.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                    
                    <div class="lg:col-span-3">
                        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 h-full flex flex-col items-center justify-center relative overflow-hidden">
                            
                            <!-- RF04 PUNTO 18: INDICADOR VISUAL DEL ESTADO -->
                            <div class="mb-6 relative z-10">
                                @if(!$esBeneficiario)
                                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-bold border border-red-200">
                                        <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span> No eres beneficiario
                                    </span>
                                @elseif($yaCanjeoHoy)
                                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-gray-100 text-gray-500 text-sm font-bold border border-gray-200">
                                        <span class="w-2 h-2 bg-gray-400 rounded-full mr-2"></span> Ya canjeado hoy
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-bold border border-green-200">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span> Beneficio disponible
                                    </span>
                                @endif
                            </div>

                            <!-- RF04 PUNTO 21: CÓDIGO QR DINÁMICO -->
                            <div class="bg-fp-qr p-8 rounded-3xl mb-8 relative z-10 border border-green-200/50 shadow-inner">
                                <div class="bg-white p-4 rounded-xl shadow-sm">
                                    <!-- Aquí generamos el QR real usando el ID del usuario -->
                                    {!! QrCode::size(192)->generate($user->id) !!}
                                </div>
                            </div>

                            <div class="inline-flex items-center bg-gray-50 border border-gray-100 rounded-full px-5 py-2 mb-6">
                                <span class="font-bold text-gray-800 tracking-widest text-lg font-mono">ID: USER-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>

                            <!-- RF04 PUNTO 19: BLOQUEO VISUAL Y MENSAJE -->
                            <form id="form-canje" action="{{ route('canje.store') }}" method="POST" class="w-full max-w-md">
                                @csrf
                                <button type="button" id="btnCanjear" 
                                    class="w-full font-semibold text-lg py-4 px-8 rounded-2xl shadow-lg transition-all transform 
                                    {{ (!$esBeneficiario || $yaCanjeoHoy) ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-fp-orange hover:bg-fp-orangeHover text-white hover:-translate-y-0.5 active:translate-y-0 shadow-orange-500/30' }}"
                                    {{ (!$esBeneficiario || $yaCanjeoHoy) ? 'disabled' : '' }}>
                                    Canjear Ahora
                                </button>
                                
                                @if($yaCanjeoHoy)
                                    <p class="text-center text-red-500 text-sm font-medium mt-4 bg-red-50 p-2 rounded-lg">
                                        Ya utilizaste tu beneficio alimentario en este periodo.
                                    </p>
                                @endif
                            </form>
                        </div>
                    </div>

                    <!-- COLUMNA DERECHA (Saldo y Ayuda) -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-fp-dark rounded-[2rem] p-8 shadow-xl relative overflow-hidden text-white">
                            <p class="text-white/60 text-xs font-bold tracking-widest mb-2">ESTADO DE BENEFICIO</p>
                            <h2 class="text-3xl font-extrabold tracking-tight mb-4">
                                {{ $esBeneficiario ? 'SENA ACTIVO' : 'NO ASIGNADO' }}
                            </h2>
                            <div class="flex items-center">
                                <span class="text-white/60 text-sm font-medium">Actualizado: {{ date('d/m/Y') }}</span>
                            </div>
                        </div>

                        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                ¿Cómo funciona?
                            </h3>
                            <div class="space-y-4">
                                <div class="flex">
                                    <div class="w-6 h-6 rounded-full bg-fp-light text-fp-dark flex items-center justify-center text-xs font-bold mr-3 mt-1">1</div>
                                    <p class="text-gray-600 text-sm">Presenta tu QR en la caja del restaurante.</p>
                                </div>
                                <div class="flex">
                                    <div class="w-6 h-6 rounded-full bg-fp-light text-fp-dark flex items-center justify-center text-xs font-bold mr-3 mt-1">2</div>
                                    <p class="text-gray-600 text-sm">El cajero validará tu identidad y beneficio.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- RF04 PUNTO 20: MODAL DE CONFIRMACIÓN -->
    <script>
        document.getElementById('btnCanjear').addEventListener('click', function() {
            Swal.fire({
                title: '¿Deseas usar tu beneficio alimentario hoy?',
                text: "Esta acción no se puede deshacer y marcará tu beneficio como utilizado para el día de hoy.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#f97316', // Color fp-orange
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Sí, canjear',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                border: 'none',
                customClass: {
                    popup: 'rounded-[2rem]'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si confirma, enviamos el formulario
                    document.getElementById('form-canje').submit();
                }
            })
        });
    </script>

</body>
</html>