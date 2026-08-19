<<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial - FoodPass</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f0ffd8; color: #121f05; }
        .sidebar { background-color: #273517; }
        .text-foodpass-orange { color: #F97F2D; }
        .bg-foodpass-orange { background-color: #F97F2D; }
        .text-foodpass-green { color: #006e16; }
    </style>
</head>
<body class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="sidebar w-56 h-full flex flex-col fixed left-0 top-0 text-white z-20">
        <div class="p-6">
            <h1 class="text-2xl font-bold tracking-tight">FoodPass</h1>
            <p class="text-[10px] tracking-[0.2em] text-white/60 mt-1 uppercase">The Artisanal Ledger</p>
        </div>

        <nav class="flex-1 px-4 mt-6 space-y-1">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined text-[20px]">home</span>
                <span class="text-sm font-medium">Inicio</span>
            </a>
            <a href="{{ route('menu-digital') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined text-[20px]">restaurant_menu</span>
                <span class="text-sm font-medium">Menú</span>
            </a>
            <a href="{{ route('historial') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-foodpass-orange/20 text-[#F97F2D] transition-colors">
                <span class="material-symbols-outlined text-[20px]">history</span>
                <span class="text-sm font-medium">Historial</span>
            </a>
            <a href="{{ route('canje') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined text-[20px]">redeem</span>
                <span class="text-sm font-medium">Canje</span>
            </a>
            <a href="{{ route('metodos-pago') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined text-[20px]">payments</span>
                <span class="text-sm font-medium">Pagos</span>
            </a>
            <a href="{{ route('perfil') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 hover:text-white hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined text-[20px]">person</span>
                <span class="text-sm font-medium">Perfil</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3 px-2 py-2">
                <div class="w-8 h-8 rounded-full bg-foodpass-orange flex items-center justify-center font-bold text-sm">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-white/60 truncate">Membresía Gourmet</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-56 flex flex-col h-full relative">
        <!-- Header -->
        <header class="h-14 bg-white/80 backdrop-blur-md flex items-center justify-between px-8 border-b border-black/5 z-10 shrink-0">
            <div class="w-96 relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px]">search</span>
                <input type="text" placeholder="Buscar pedidos..." class="w-full pl-9 pr-4 py-1.5 bg-gray-100/50 rounded-lg text-sm focus:outline-none">
            </div>
            <div class="flex items-center gap-5">
                <div class="flex items-center gap-3 border-l pl-5 border-gray-200">
                    <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=F97F2D&color=fff" class="w-8 h-8 rounded-full">
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-6xl mx-auto space-y-8 pb-20">
                
                <!-- RF05 PUNTO 22: TOP STATS DINÁMICOS -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 bg-white rounded-2xl p-8 shadow-sm border border-black/5">
                        <h2 class="text-2xl font-bold mb-2">Tu Trayectoria Gastronómica</h2>
                        <p class="text-gray-500 text-sm mb-8">Aquí puedes ver el resumen de tus consumos y beneficios utilizados.</p>
                        
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-xs text-gray-400 font-medium mb-1 uppercase tracking-wider">TOTAL PEDIDOS</p>
                                <p class="text-4xl font-bold text-[#F97F2D]">{{ $pedidos->total() }}</p>
                            </div>
                            <div class="w-px h-16 bg-gray-100 mx-8"></div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-400 font-medium mb-1 uppercase tracking-wider">ESTADO</p>
                                <p class="text-4xl font-bold text-[#006e16]">{{ auth()->user()->es_beneficiario_sena ? 'SENA' : 'Standard' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="lg:col-span-1 bg-[#273517] rounded-2xl p-8 text-white flex flex-col items-center justify-center relative overflow-hidden shadow-sm">
                        <div class="w-16 h-16 rounded-full bg-[#F97F2D] flex items-center justify-center mb-4 z-10">
                            <span class="material-symbols-outlined text-[32px]">emoji_events</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2 z-10">Miembro Gourmet</h3>
                        <p class="text-white/60 text-sm text-center mb-6 z-10">Sigue redimiendo tus beneficios en locales aliados.</p>
                    </div>
                </div>

                <!-- RF05 PUNTO 23: FILTROS FUNCIONALES -->
                <div class="flex items-center justify-between">
                    <div class="flex gap-2">
                        <a href="{{ route('historial') }}" 
                           class="px-5 py-2 rounded-full text-sm font-medium border transition-all {{ !request('filter') ? 'bg-black text-white' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                           Todos
                        </a>
                        <a href="{{ route('historial', ['filter' => 'ultimos_30']) }}" 
                           class="px-5 py-2 rounded-full text-sm font-medium border transition-all {{ request('filter') == 'ultimos_30' ? 'bg-black text-white' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                           Últimos 30 días
                        </a>
                        <a href="{{ route('historial', ['filter' => 'pendientes']) }}" 
                           class="px-5 py-2 rounded-full text-sm font-medium border transition-all {{ request('filter') == 'pendientes' ? 'bg-black text-white' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                           Pendientes
                        </a>
                    </div>
                </div>

                <!-- RF05 PUNTO 22: TABLA CON @foreach Y DATOS REALES -->
                <div class="bg-white rounded-2xl shadow-sm border border-black/5 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold">Historial de Pedidos</h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100 bg-gray-50/50">
                                    <th class="py-4 px-6 font-medium">PEDIDO</th>
                                    <th class="py-4 px-6 font-medium">DETALLE</th>
                                    <th class="py-4 px-6 font-medium">FECHA</th>
                                    <th class="py-4 px-6 font-medium">ESTADO</th>
                                    <th class="py-4 px-6 font-medium text-right">ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @forelse($pedidos as $pedido)
                                <tr class="hover:bg-gray-50/50 transition-colors group">
                                    <td class="py-4 px-6 font-medium text-gray-900">#FP-{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600">
                                                <span class="material-symbols-outlined text-[16px]">restaurant</span>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $pedido->detalle ?? 'Beneficio Alimentario' }}</p>
                                                <p class="text-xs text-gray-500">Canje Único</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-500">{{ $pedido->created_at->format('d M, H:i') }}</td>
                                    <td class="py-4 px-6">
                                        @if($pedido->estado == 'entregado')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">ENTREGADO</span>
                                        @elseif($pedido->estado == 'pendiente')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">PENDIENTE</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">CANCELADO</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <!-- RF05 PUNTO 25: NAVEGAR A VISTA DE DETALLE -->
                                        <a href="{{ route('historial.show', $pedido->id) }}" class="text-gray-400 hover:text-[#F97F2D] transition-colors p-1">
                                            <span class="material-symbols-outlined">receipt_long</span>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-10 text-center text-gray-400 italic">No tienes pedidos registrados aún.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- RF05 PUNTO 24: PAGINACIÓN FUNCIONAL -->
                    <div class="p-4 border-t border-gray-100 flex items-center justify-between text-sm text-gray-500">
                        <p>Mostrando {{ $pedidos->firstItem() ?? 0 }} a {{ $pedidos->lastItem() ?? 0 }} de {{ $pedidos->total() }} pedidos</p>
                        <div class="flex gap-2">
                            @if ($pedidos->onFirstPage())
                                <span class="w-8 h-8 rounded-lg flex items-center justify-center bg-gray-50 text-gray-300 cursor-not-allowed">
                                    <span class="material-symbols-outlined text-[20px]">chevron_left</span>
                                </span>
                            @else
                                <a href="{{ $pedidos->previousPageUrl() }}" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-gray-100 text-gray-700">
                                    <span class="material-symbols-outlined text-[20px]">chevron_left</span>
                                </a>
                            @endif

                            @if ($pedidos->hasMorePages())
                                <a href="{{ $pedidos->nextPageUrl() }}" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-gray-100 text-gray-700">
                                    <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                                </a>
                            @else
                                <span class="w-8 h-8 rounded-lg flex items-center justify-center bg-gray-50 text-gray-300 cursor-not-allowed">
                                    <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- FAB -->
        <a href="{{ route('canje') }}" class="fixed bottom-8 right-8 w-14 h-14 bg-[#F97F2D] hover:bg-[#e06d20] text-white rounded-full shadow-lg flex items-center justify-center transition-transform hover:scale-105 z-50">
            <span class="material-symbols-outlined text-[28px]">add</span>
        </a>
    </main>
</body>
</html>