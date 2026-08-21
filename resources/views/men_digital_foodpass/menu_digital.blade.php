<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- RNF05: Seguridad - Token CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menú Digital - FoodPass</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'fp-sidebar': '#273517',
                        'fp-orange': '#F97F2D',
                        'fp-bg': '#f0ffd8',
                        'fp-card-light': '#e2f4c8',
                        'fp-text-dark': '#121f05'
                    },
                    fontFamily: {
                        'title': ['"Plus Jakarta Sans"', 'sans-serif'],
                        'body': ['"Inter"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-title { font-family: 'Plus Jakarta Sans', sans-serif; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.2); }
    </style>
</head>
<body class="bg-fp-bg text-fp-text-dark antialiased h-screen overflow-hidden flex">

    <!-- Sidebar Izquierdo Fijo -->
    <aside class="w-56 bg-fp-sidebar h-screen flex flex-col justify-between fixed left-0 top-0 z-20 text-white shrink-0">
        <div>
            <div class="px-6 py-8">
                <h1 class="text-2xl font-title font-bold tracking-tight">FoodPass</h1>
                <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-widest mt-1">The Artisanal Ledger</p>
            </div>

            <nav class="px-3 flex flex-col gap-1">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[20px]">home</span>
                    <span class="text-sm font-medium">Inicio</span>
                </a>
                <a href="{{ route('menu-digital') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-fp-orange text-white shadow-md shadow-fp-orange/20 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">restaurant_menu</span>
                    <span class="text-sm font-medium">Menú</span>
                </a>
                <a href="{{ route('historial') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[20px]">receipt_long</span>
                    <span class="text-sm font-medium">Historial</span>
                </a>
                <a href="{{ route('canje') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[20px]">loyalty</span>
                    <span class="text-sm font-medium">Canje</span>
                </a>
                <a href="{{ route('metodos-pago') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[20px]">credit_card</span>
                    <span class="text-sm font-medium">Pagos</span>
                </a>
                <a href="{{ route('perfil') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[20px]">person</span>
                    <span class="text-sm font-medium">Perfil</span>
                </a>
            </nav>
        </div>

        <div class="p-4 mb-4 mx-3 rounded-xl bg-black/20 border border-white/5 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-fp-orange flex items-center justify-center font-bold text-white shrink-0 shadow-inner">
                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? 'Usuario Invitado' }}</p>
                <p class="text-xs text-fp-orange">Premium Account</p>
            </div>
        </div>
    </aside>

    <div class="ml-56 flex-1 flex flex-col h-screen w-full relative">
        
        <header class="h-14 bg-white/80 backdrop-blur-md border-b border-gray-200/50 flex items-center justify-between px-8 sticky top-0 z-10 w-full">
            <div class="relative w-96">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">search</span>
                <input type="text" placeholder="Buscar platillos..." class="w-full bg-fp-bg border border-fp-card-light text-sm rounded-full py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-fp-orange/50 transition-shadow">
            </div>

            <div class="flex items-center gap-5">
                <button class="relative text-gray-600 hover:text-fp-sidebar transition-colors">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-fp-orange rounded-full border-2 border-white"></span>
                </button>
                <div class="flex items-center gap-2 border-l border-gray-200 pl-5">
                    <span class="text-sm font-medium text-fp-text-dark">{{ auth()->user()->name ?? 'Usuario Invitado' }}</span>
                    <div class="w-8 h-8 rounded-full bg-fp-sidebar text-white flex items-center justify-center text-xs font-bold">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8 pb-20">
            
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
                
                <div class="lg:col-span-2 relative rounded-3xl overflow-hidden h-64 shadow-lg group">
                    @if($platilloHero)
                        <!-- RNF02: Imagen con loading="lazy" -->
                        <img src="https://picsum.photos/seed/{{ Str::slug($platilloHero->nombre) }}/1200/600"
                             alt="{{ $platilloHero->nombre }}"
                             loading="lazy" 
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/50 to-transparent"></div>

                        <div class="relative h-full flex flex-col justify-center p-8 lg:w-2/3">
                            <div class="inline-block px-3 py-1 bg-fp-orange text-white text-[10px] font-bold uppercase tracking-wider rounded-md mb-4 self-start">Recomendación del Chef</div>
                            <h2 class="text-3xl md:text-4xl font-title font-bold text-white leading-tight mb-3">{{ $platilloHero->nombre }}</h2>
                            <p class="text-white/70 text-sm mb-6 max-w-md line-clamp-2">{{ $platilloHero->descripcion }}</p>
                            <button class="bg-fp-orange hover:bg-[#e06c1c] text-white px-6 py-2.5 rounded-xl font-semibold text-sm flex items-center gap-2 self-start transition-colors btn-action">
                                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                                Seleccionar &nbsp; ${{ number_format($platilloHero->precio, 0, ',', '.') }}
                            </button>
                        </div>
                    @endif
                </div>

                <div class="flex flex-col gap-6 h-64">
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex-1 flex flex-col justify-center relative overflow-hidden group">
                        <div class="flex items-center gap-3 mb-2 relative">
                            <div class="w-10 h-10 rounded-full bg-fp-orange/10 flex items-center justify-center text-fp-orange"><span class="material-symbols-outlined">stars</span></div>
                            <h3 class="font-title font-bold text-lg">Puntos Pass</h3>
                        </div>
                        <p class="text-gray-500 text-sm mb-3">Tienes <span class="font-bold text-fp-sidebar">1,250</span> puntos.</p>
                        <a href="{{ route('canje') }}" class="text-fp-orange text-sm font-semibold hover:underline inline-flex items-center gap-1">Ver catálogo <span class="material-symbols-outlined text-[16px]">arrow_forward</span></a>
                    </div>
                    <div class="bg-fp-card-light rounded-3xl p-6 shadow-sm flex-1 flex flex-col justify-center relative overflow-hidden group border border-[#d2ebaf]">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-title font-bold text-lg text-fp-sidebar">Veggie</h3>
                            <span class="material-symbols-outlined text-green-600">eco</span>
                        </div>
                        <p class="text-fp-text-dark/80 text-sm">Opciones saludables hoy.</p>
                    </div>
                </div>
            </section>

            <section>
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                    <div>
                        <h2 class="text-2xl font-title font-bold text-fp-sidebar mb-1">Explora nuestro Menú</h2>
                        <p class="text-gray-500 text-sm">Elige entre nuestras categorías.</p>
                    </div>
                    
                    <div class="flex items-center gap-2 p-1 bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
                        <button class="px-4 py-2 text-sm font-medium rounded-lg bg-fp-text-dark text-white">Todos</button>
                        <button class="px-4 py-2 text-sm font-medium text-gray-500 rounded-lg hover:text-fp-sidebar">Entradas</button>
                    </div>
                </div>

                <!-- RNF03: Grid adaptativo 1 -> 2 -> 4 columnas -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    @forelse($platillos as $platillo)
                        <div class="bg-white rounded-3xl p-4 shadow-sm border border-gray-100 hover:shadow-md transition-shadow group flex flex-col">
                            <div class="relative w-full h-40 rounded-2xl overflow-hidden mb-4">
                                <!-- RNF02: Imágenes con carga perezosa -->
                                <img src="{{ $platillo->imagen ? asset('storage/' . $platillo->imagen) : 'https://picsum.photos/seed/' . Str::slug($platillo->nombre) . '/400/300' }}"
                                     alt="{{ $platillo->nombre }}"
                                     loading="lazy" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <span class="absolute top-3 left-3 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase bg-fp-orange text-white">
                                    {{ str_replace('_', ' ', $platillo->categoria) }}
                                </span>
                            </div>

                            <h3 class="font-title font-bold text-fp-sidebar mb-1 line-clamp-1">{{ $platillo->nombre }}</h3>
                            <p class="text-xs text-gray-400 mb-4 line-clamp-2 flex-1">{{ $platillo->descripcion }}</p>

                            <div class="flex items-center justify-between mt-auto">
                                <span class="font-title font-extrabold text-lg text-fp-orange">${{ number_format($platillo->precio, 0, ',', '.') }}</span>
                                <button class="bg-fp-orange/10 hover:bg-fp-orange text-fp-orange hover:text-white px-4 py-1.5 rounded-lg text-sm font-semibold transition-colors btn-action">
                                    Seleccionar
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center">No hay platillos disponibles.</div>
                    @endforelse

                </div>
            </section>
        </main>
    </div>

    <!-- RNF07: Script de Retroalimentación (Spinner en botones) -->
    <script>
        document.querySelectorAll('.btn-action').forEach(button => {
            button.addEventListener('click', function() {
                const originalContent = this.innerHTML;
                this.disabled = true;
                this.classList.add('opacity-70');
                this.innerHTML = `<span class="flex items-center gap-2"><div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div> Procesando...</span>`;
                
                // Simulación de carga (reemplazar con lógica real de envío)
                setTimeout(() => {
                    this.disabled = false;
                    this.classList.remove('opacity-70');
                    this.innerHTML = originalContent;
                }, 1500);
            });
        });
    </script>
</body>
</html>