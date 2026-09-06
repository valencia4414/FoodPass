<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menú Digital - FoodPass</title>
    
    <!-- Tipografía Oficial: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    
    <!-- Alpine.js para manejo dinámico del Carrito sin recargar página -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind CSS con Paleta Oficial FoodPass -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'fp-orange': '#F97F2D',      /* Naranja Otoñal */
                        'fp-green': '#2F9B34',       /* Verde Jungla Medio */
                        'fp-bronze': '#C45A1B',      /* Bronce Especiado */
                        'fp-darkgreen': '#283618',   /* Verde Selva Negra */
                        'fp-sidebar': '#283618',
                        'fp-bg': '#F9FBF7',
                        'fp-card-light': '#EBF7E7'
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-fp-bg text-fp-darkgreen antialiased h-screen overflow-hidden flex" 
      x-data="carritoApp()">
    @include('partials.sidebar')

    <div class="ml-64 flex-1 flex flex-col h-screen w-full relative">
        
        <!-- Header con Buscador (Tarea 11) e Ícono del Carrito con Contador (Tarea 13) -->
        <header class="h-16 bg-white/90 backdrop-blur-md border-b border-gray-200/60 flex items-center justify-between px-8 sticky top-0 z-10 w-full">
            
            <!-- Tarea 11: Buscador de Platillos en Tiempo Real -->
            <div class="relative w-96">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">search</span>
                <input type="text" 
                       x-model="busqueda" 
                       placeholder="Buscar platillos o ingredientes..." 
                       class="w-full bg-fp-bg border border-gray-200 text-sm rounded-full py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-fp-orange/50 transition-shadow">
            </div>

            <div class="flex items-center gap-5">
                <!-- Tarea 13: Botón del Carrito con Contador Dinámico -->
                <button @click="abrirCarrito = true" 
                        class="relative flex items-center gap-2 px-4 py-2 border border-black rounded-lg text-black hover:bg-gray-100 transition-colors font-medium text-sm">
                    <span class="material-symbols-outlined text-[20px]">shopping_cart</span>
                    <span>Carrito</span>
                    <template x-if="totalItems > 0">
                        <span class="ml-1 px-2 py-0.5 bg-fp-orange text-white text-xs font-bold rounded-full" 
                              x-text="totalItems"></span>
                    </template>
                </button>

                <div class="flex items-center gap-2 border-l border-gray-200 pl-5">
                    <span class="text-sm font-medium text-fp-darkgreen">{{ auth()->user()->name ?? 'Usuario SENA' }}</span>
                    <div class="w-8 h-8 rounded-full bg-fp-green text-white flex items-center justify-center text-xs font-bold">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8 pb-20">
            
            <!-- Hero / Recomendados -->
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="lg:col-span-2 relative rounded-3xl overflow-hidden h-64 shadow-md group">
                    @if($platilloHero)
                        <img src="https://picsum.photos/seed/{{ Str::slug($platilloHero->nombre) }}/1200/600"
                             alt="{{ $platilloHero->nombre }}"
                             loading="lazy" 
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/50 to-transparent"></div>

                        <div class="relative h-full flex flex-col justify-center p-8 lg:w-2/3">
                            <div class="inline-block px-3 py-1 bg-fp-orange text-white text-[10px] font-bold uppercase tracking-wider rounded-md mb-3 self-start">Plato Recomendado del Día</div>
                            <h2 class="text-3xl font-bold text-white leading-tight mb-2">{{ $platilloHero->nombre }}</h2>
                            <p class="text-white/80 text-xs mb-4 max-w-md line-clamp-2">{{ $platilloHero->descripcion }}</p>
                            
                            <button @click="agregarAlCarrito({ id: {{ $platilloHero->id }}, nombre: '{{ addslashes($platilloHero->nombre) }}', precio: {{ $platilloHero->precio }} })" 
                                    class="bg-fp-orange hover:bg-fp-bronze text-white px-6 py-2.5 rounded-xl font-semibold text-sm flex items-center gap-2 self-start transition-colors">
                                <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                                Seleccionar &nbsp; ${{ number_format($platilloHero->precio, 0, ',', '.') }}
                            </button>
                        </div>
                    @endif
                </div>

                <div class="flex flex-col gap-4 h-64">
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex-1 flex flex-col justify-center">
                        <div class="flex items-center gap-3 mb-1">
                            <div class="w-10 h-10 rounded-full bg-fp-orange/10 flex items-center justify-center text-fp-orange"><span class="material-symbols-outlined">stars</span></div>
                            <h3 class="font-bold text-base text-fp-darkgreen">Puntos FoodPass</h3>
                        </div>
                        <p class="text-gray-500 text-xs mb-2">Tienes <span class="font-bold text-fp-green">1,250</span> puntos acumulados.</p>
                        <a href="{{ route('canje') }}" class="text-fp-orange text-xs font-semibold hover:underline inline-flex items-center gap-1">Ver catálogo de canje <span class="material-symbols-outlined text-[14px]">arrow_forward</span></a>
                    </div>
                    <div class="bg-fp-card-light rounded-3xl p-6 shadow-sm flex-1 flex flex-col justify-center border border-[#d2ebaf]">
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="font-bold text-base text-fp-darkgreen">Beneficio SENA</h3>
                            <span class="material-symbols-outlined text-fp-green">verified</span>
                        </div>
                        <p class="text-fp-darkgreen/80 text-xs">Reclama 1 almuerzo diario con tu QR.</p>
                    </div>
                </div>
            </section>

            <!-- Sección de Menú Digital -->
            <section>
                <!-- Tarea 10: Filtros de Categoría Funcionales -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-fp-darkgreen mb-1">Menú Digital</h2>
                        <p class="text-gray-500 text-xs">Selecciona tus alimentos frescos de la cafetería.</p>
                    </div>
                    
                    <div class="flex items-center gap-2 p-1.5 bg-white rounded-xl shadow-sm border border-gray-200 overflow-x-auto">
                        <button @click="categoriaFiltro = 'todos'" 
                                :class="categoriaFiltro === 'todos' ? 'bg-fp-green text-white font-semibold' : 'text-gray-600 hover:text-fp-darkgreen'" 
                                class="px-4 py-1.5 text-xs rounded-lg transition-colors">Todos</button>
                        <button @click="categoriaFiltro = 'plato_fuerte'" 
                                :class="categoriaFiltro === 'plato_fuerte' ? 'bg-fp-green text-white font-semibold' : 'text-gray-600 hover:text-fp-darkgreen'" 
                                class="px-4 py-1.5 text-xs rounded-lg transition-colors">Platos Fuertes</button>
                        <button @click="categoriaFiltro = 'entrada'" 
                                :class="categoriaFiltro === 'entrada' ? 'bg-fp-green text-white font-semibold' : 'text-gray-600 hover:text-fp-darkgreen'" 
                                class="px-4 py-1.5 text-xs rounded-lg transition-colors">Entradas</button>
                        <button @click="categoriaFiltro = 'postre'" 
                                :class="categoriaFiltro === 'postre' ? 'bg-fp-green text-white font-semibold' : 'text-gray-600 hover:text-fp-darkgreen'" 
                                class="px-4 py-1.5 text-xs rounded-lg transition-colors">Postres</button>
                        <button @click="categoriaFiltro = 'bebida'" 
                                :class="categoriaFiltro === 'bebida' ? 'bg-fp-green text-white font-semibold' : 'text-gray-600 hover:text-fp-darkgreen'" 
                                class="px-4 py-1.5 text-xs rounded-lg transition-colors">Bebidas</button>
                    </div>
                </div>

                <!-- Tarea 8: Grid Iterado de Platillos Reales -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    @forelse($platillos as $platillo)
                        <div x-show="cumpleFiltro('{{ $platillo->categoria }}', '{{ strtolower($platillo->nombre) }}', '{{ strtolower($platillo->descripcion) }}')"
                             class="bg-white rounded-3xl p-4 shadow-sm border border-gray-100 hover:shadow-md transition-all flex flex-col justify-between relative group">
                            
                            <!-- Tarea 12: Abrir modal al tocar la imagen -->
                            <div class="relative w-full h-40 rounded-2xl overflow-hidden mb-3 cursor-pointer" 
                                 @click="abrirDetalle({ id: {{ $platillo->id }}, nombre: '{{ addslashes($platillo->nombre) }}', descripcion: '{{ addslashes($platillo->descripcion) }}', precio: {{ $platillo->precio }}, categoria: '{{ $platillo->categoria }}', ingredientes: '{{ addslashes($platillo->ingredientes ?? '') }}', imagen: '{{ $platillo->imagen }}' })">
                                
                                <img src="{{ $platillo->imagen ? asset('storage/' . $platillo->imagen) : 'https://picsum.photos/seed/' . Str::slug($platillo->nombre) . '/400/300' }}"
                                     alt="{{ $platillo->nombre }}"
                                     loading="lazy" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 {{ !$platillo->disponible ? 'grayscale opacity-60' : '' }}">
                                
                                <!-- Badge de Categoría -->
                                <span class="absolute top-3 left-3 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase bg-fp-darkgreen text-white">
                                    {{ str_replace('_', ' ', $platillo->categoria) }}
                                </span>

                                <!-- Tarea 9: Badge Visual "AGOTADO" si disponible = false -->
                                @if(!$platillo->disponible)
                                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                        <span class="px-3 py-1 bg-red-600 text-white text-xs font-bold uppercase tracking-wider rounded-lg shadow-md">AGOTADO</span>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <h3 @click="abrirDetalle({ id: {{ $platillo->id }}, nombre: '{{ addslashes($platillo->nombre) }}', descripcion: '{{ addslashes($platillo->descripcion) }}', precio: {{ $platillo->precio }}, categoria: '{{ $platillo->categoria }}', ingredientes: '{{ addslashes($platillo->ingredientes ?? '') }}', imagen: '{{ $platillo->imagen }}' })" 
                                    class="font-bold text-fp-darkgreen mb-1 line-clamp-1 cursor-pointer hover:text-fp-orange transition-colors">
                                    {{ $platillo->nombre }}
                                </h3>
                                <p class="text-xs text-gray-500 mb-4 line-clamp-2">{{ $platillo->descripcion }}</p>
                            </div>

                            <div class="flex items-center justify-between pt-2 border-t border-gray-50 mt-auto">
                                <span class="font-bold text-lg text-fp-orange">${{ number_format($platillo->precio, 0, ',', '.') }}</span>
                                
                                <!-- Tarea 13: Botón Seleccionar directo sin advertencias de sintaxis -->
                                @if($platillo->disponible)
                                    <button @click="agregarAlCarrito({ id: {{ $platillo->id }}, nombre: '{{ addslashes($platillo->nombre) }}', precio: {{ $platillo->precio }} })" 
                                            class="bg-fp-orange hover:bg-fp-bronze text-white px-4 py-1.5 rounded-lg text-xs font-semibold transition-colors flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">add</span> Seleccionar
                                    </button>
                                @else
                                    <button disabled 
                                            class="bg-gray-200 text-gray-400 cursor-not-allowed px-4 py-1.5 rounded-lg text-xs font-semibold">
                                        Agotado
                                    </button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center text-gray-400">No hay platillos registrados en el sistema.</div>
                    @endforelse

                </div>
            </section>
        </main>
    </div>

    <!-- TAREA 12: MODAL DE DETALLE DEL PLATILLO -->
    <div x-show="modalDetalle" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
         x-transition>
        <div class="bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl relative" @click.away="modalDetalle = false">
            
            <button @click="modalDetalle = false" class="absolute top-4 right-4 bg-white/80 rounded-full p-1.5 text-gray-600 hover:text-black z-10">
                <span class="material-symbols-outlined">close</span>
            </button>

            <template x-if="platilloSeleccionado">
                <div>
                    <div class="h-56 relative">
                        <img :src="platilloSeleccionado.imagen ? '/storage/' + platilloSeleccionado.imagen : 'https://picsum.photos/seed/' + platilloSeleccionado.nombre + '/600/400'" 
                             class="w-full h-full object-cover">
                        <span class="absolute bottom-3 left-4 px-3 py-1 bg-fp-orange text-white text-xs font-bold rounded-md uppercase" 
                              x-text="platilloSeleccionado.categoria"></span>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-fp-darkgreen" x-text="platilloSeleccionado.nombre"></h3>
                            <span class="text-xl font-bold text-fp-orange" x-text="'$' + Number(platilloSeleccionado.precio).toLocaleString('es-CO')"></span>
                        </div>
                        <p class="text-sm text-gray-600 mb-4" x-text="platilloSeleccionado.descripcion"></p>

                        <div class="mb-6 bg-fp-bg p-4 rounded-xl border border-gray-100">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-fp-darkgreen mb-1">Ingredientes:</h4>
                            <p class="text-xs text-gray-500" x-text="platilloSeleccionado.ingredientes || 'Ingredientes frescos seleccionados del día.'"></p>
                        </div>

                        <button @click="agregarAlCarrito(platilloSeleccionado); modalDetalle = false;" 
                                class="w-full bg-fp-orange hover:bg-fp-bronze text-white font-bold py-3 rounded-xl transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">shopping_bag</span>
                            <span>Agregar al pedido</span>
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- TAREA 14, 15 y 16: PANEL LATERAL DEL CARRITO DE COMPRAS -->
    <div x-show="abrirCarrito" 
         x-cloak 
         class="fixed inset-0 z-50 overflow-hidden bg-black/50 backdrop-blur-sm"
         x-transition>
        <div class="absolute inset-y-0 right-0 max-w-full flex pl-10">
            <div class="w-screen max-w-md bg-white shadow-xl flex flex-col justify-between" @click.away="abrirCarrito = false">
                
                <!-- Encabezado del Carrito -->
                <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-fp-bg">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-fp-orange">shopping_cart</span>
                        <h2 class="text-lg font-bold text-fp-darkgreen">Carrito de Pedidos</h2>
                    </div>
                    <button @click="abrirCarrito = false" class="text-gray-400 hover:text-black">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <!-- Tarea 14: Lista de Productos Seleccionados -->
                <div class="flex-1 overflow-y-auto p-6 space-y-4">
                    <template x-if="carrito.length === 0">
                        <div class="h-full flex flex-col items-center justify-center text-gray-400 py-12">
                            <span class="material-symbols-outlined text-5xl mb-2 text-gray-300">remove_shopping_cart</span>
                            <p class="text-sm font-medium">Tu carrito está vacío.</p>
                            <p class="text-xs text-gray-400 mt-1">Elige platillos deliciosos del menú.</p>
                        </div>
                    </template>

                    <template x-for="(item, index) in carrito" :key="item.id">
                        <div class="flex items-center justify-between p-3 bg-fp-bg rounded-2xl border border-gray-100">
                            <div class="flex-1 pr-3">
                                <h4 class="text-sm font-bold text-fp-darkgreen" x-text="item.nombre"></h4>
                                <span class="text-xs font-semibold text-fp-orange" x-text="'$' + Number(item.precio * item.cantidad).toLocaleString('es-CO')"></span>
                            </div>

                            <!-- Tarea 15: Botones (+ / -) para Ajustar Cantidades -->
                            <div class="flex items-center gap-2 bg-white px-2 py-1 rounded-lg border border-gray-200">
                                <button @click="disminuirCantidad(index)" class="text-gray-500 hover:text-red-500 font-bold px-1 text-sm">-</button>
                                <span class="text-xs font-bold w-4 text-center" x-text="item.cantidad"></span>
                                <button @click="aumentarCantidad(index)" class="text-gray-500 hover:text-fp-green font-bold px-1 text-sm">+</button>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Tarea 16: Total del Pedido en Tiempo Real -->
                <div class="p-6 border-t border-gray-100 bg-white space-y-4">
                    <div class="flex justify-between items-center text-sm font-medium text-gray-600">
                        <span>Subtotal:</span>
                        <span class="font-bold text-fp-darkgreen" x-text="'$' + totalPrecio.toLocaleString('es-CO')"></span>
                    </div>
                    <div class="flex justify-between items-center text-lg font-bold text-fp-darkgreen border-t border-gray-100 pt-2">
                        <span>Total Pedido:</span>
                        <span class="text-fp-orange" x-text="'$' + totalPrecio.toLocaleString('es-CO')"></span>
                    </div>

                    <button @click="abrirConfirmacion = true; abrirCarrito = false;" 
                            :disabled="carrito.length === 0"
                            :class="carrito.length === 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-fp-orange hover:bg-fp-bronze'"
                            class="w-full text-white font-bold py-3 rounded-xl transition-colors flex items-center justify-center gap-2">
                        <span>Proceder a pagar</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- TAREA 17: PANTALLA / MODAL DE CONFIRMACIÓN DEL PEDIDO -->
    <div x-show="abrirConfirmacion" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
         x-transition>
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl relative" @click.away="abrirConfirmacion = false">
            
            <h3 class="text-xl font-bold text-fp-darkgreen mb-1">Resumen del Pedido</h3>
            <p class="text-xs text-gray-500 mb-4">Verifica tus productos y selecciona el método de pago.</p>

            <!-- Resumen de items -->
            <div class="max-h-40 overflow-y-auto mb-4 border-y border-gray-100 py-2 space-y-2">
                <template x-for="item in carrito" :key="item.id">
                    <div class="flex justify-between text-xs">
                        <span x-text="item.cantidad + 'x ' + item.nombre" class="font-medium text-fp-darkgreen"></span>
                        <span x-text="'$' + Number(item.precio * item.cantidad).toLocaleString('es-CO')" class="font-bold text-gray-700"></span>
                    </div>
                </template>
            </div>

            <!-- Selector de Método de Pago -->
            <div class="mb-6">
                <label class="block text-xs font-bold uppercase tracking-wider text-fp-darkgreen mb-2">Método de Pago:</label>
                <div class="grid grid-cols-2 gap-2">
                    <button @click="metodoPago = 'Efectivo'" 
                            :class="metodoPago === 'Efectivo' ? 'border-fp-orange bg-fp-orange/10 text-fp-orange font-bold' : 'border-gray-200 text-gray-600'" 
                            class="p-2 border rounded-xl text-xs text-center transition-all">Efectivo (Caja)</button>
                    <button @click="metodoPago = 'Nequi'" 
                            :class="metodoPago === 'Nequi' ? 'border-fp-orange bg-fp-orange/10 text-fp-orange font-bold' : 'border-gray-200 text-gray-600'" 
                            class="p-2 border rounded-xl text-xs text-center transition-all">Nequi</button>
                    <button @click="metodoPago = 'Transferencia'" 
                            :class="metodoPago === 'Transferencia' ? 'border-fp-orange bg-fp-orange/10 text-fp-orange font-bold' : 'border-gray-200 text-gray-600'" 
                            class="p-2 border rounded-xl text-xs text-center transition-all">Transferencia</button>
                    <button @click="metodoPago = 'Bono SENA'" 
                            :class="metodoPago === 'Bono SENA' ? 'border-fp-green bg-fp-green/10 text-fp-green font-bold' : 'border-gray-200 text-gray-600'" 
                            class="p-2 border rounded-xl text-xs text-center transition-all">Bono SENA (Canje)</button>
                </div>
            </div>

            <div class="flex justify-between items-center mb-6 text-base font-bold text-fp-darkgreen">
                <span>Total a Pagar:</span>
                <span class="text-xl text-fp-orange" x-text="'$' + totalPrecio.toLocaleString('es-CO')"></span>
            </div>

            <!-- Botones de Acción (Confirmar o Volver) -->
            <div class="flex gap-3">
                <button @click="abrirConfirmacion = false; abrirCarrito = true;" 
                        class="flex-1 border border-black text-black py-3 rounded-xl font-bold text-xs hover:bg-gray-100 transition-colors">
                    Volver al carrito
                </button>
                <button @click="procesarPedido()" 
                        class="flex-1 bg-fp-green hover:bg-fp-darkgreen text-white py-3 rounded-xl font-bold text-xs transition-colors flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                    Confirmar pedido
                </button>
            </div>
        </div>
    </div>

    <!-- Script de Alpine.js para la Lógica de Negocio del Carrito -->
    <script>
        function carritoApp() {
            return {
                busqueda: '',
                categoriaFiltro: 'todos',
                modalDetalle: false,
                abrirCarrito: false,
                abrirConfirmacion: false,
                platilloSeleccionado: null,
                metodoPago: 'Efectivo',
                carrito: [],

                cumpleFiltro(cat, nombre, desc) {
                    const coincideCat = this.categoriaFiltro === 'todos' || cat === this.categoriaFiltro;
                    const coincideTexto = nombre.includes(this.busqueda.toLowerCase()) || desc.includes(this.busqueda.toLowerCase());
                    return coincideCat && coincideTexto;
                },

                abrirDetalle(platillo) {
                    this.platilloSeleccionado = platillo;
                    this.modalDetalle = true;
                },

                agregarAlCarrito(platillo) {
                    const existente = this.carrito.find(item => item.id === platillo.id);
                    if (existente) {
                        existente.cantidad++;
                    } else {
                        this.carrito.push({
                            id: platillo.id,
                            nombre: platillo.nombre,
                            precio: Number(platillo.precio),
                            cantidad: 1
                        });
                    }
                },

                aumentarCantidad(index) {
                    this.carrito[index].cantidad++;
                },

                disminuirCantidad(index) {
                    if (this.carrito[index].cantidad > 1) {
                        this.carrito[index].cantidad--;
                    } else {
                        this.carrito.splice(index, 1);
                    }
                },

                get totalItems() {
                    return this.carrito.reduce((sum, item) => sum + item.cantidad, 0);
                },

                get totalPrecio() {
                    return this.carrito.reduce((sum, item) => sum + (item.precio * item.cantidad), 0);
                },

                procesarPedido() {
                    const items = this.carrito.map(item => ({
                        platillo_id: item.id,
                        cantidad: item.cantidad,
                        precio: item.precio
                    }));

                    fetch('{{ route("pedido.store.web") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            metodo_pago: this.metodoPago,
                            items: items
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('¡Pedido #' + data.pedido_id + ' confirmado con éxito mediante ' + this.metodoPago + '! Tu orden pasará a la cocina de la Cafetería SENA.');
                            this.carrito = [];
                            this.abrirConfirmacion = false;
                        } else {
                            alert('Error al procesar el pedido. Inténtalo de nuevo.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error de conexión. Inténtalo de nuevo.');
                    });
                }
            }
        }
    </script>
</body>
</html>