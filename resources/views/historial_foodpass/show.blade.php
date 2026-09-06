<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Pedido - FoodPass</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f0ffd8; color: #121f05; }
        .sidebar { background-color: #273517; }
        .text-foodpass-orange { color: #F97F2D; }
        .bg-foodpass-orange { background-color: #F97F2D; }
    </style>
</head>
<body class="flex h-screen overflow-hidden">
    @include('partials.sidebar')

    <!-- Main Content -->
    <main class="flex-1 ml-64 flex flex-col h-full relative">
        <!-- Header -->
        <header class="h-14 bg-white/80 backdrop-blur-md flex items-center justify-between px-8 border-b border-black/5 z-10 shrink-0">
            <div class="flex items-center gap-4">
                <a href="{{ route('historial') }}" class="text-gray-500 hover:text-black flex items-center gap-1 text-sm font-medium">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Volver al historial
                </a>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
            </div>
        </header>

        <!-- Page Content -->
        <div class="flex-1 overflow-y-auto p-8 flex justify-center">
            <div class="max-w-md w-full">
                
                <!-- RECIBO DIGITAL -->
                <div class="bg-white rounded-[2rem] shadow-xl border border-black/5 overflow-hidden relative">
                    <!-- Decoración superior (Corte de recibo) -->
                    <div class="h-2 w-full bg-[#273517]"></div>
                    
                    <div class="p-8">
                        <!-- Icono y Título -->
                        <div class="flex flex-col items-center mb-8">
                            <div class="w-16 h-16 bg-orange-100 text-[#F97F2D] rounded-full flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-[32px]">{{ $pedido->tipo == 'canje' ? 'receipt_long' : 'shopping_bag' }}</span>
                            </div>
                            <h2 class="text-2xl font-extrabold text-gray-900">Detalle {{ $pedido->tipo == 'canje' ? 'del Canje' : 'de la Compra' }}</h2>
                            <p class="text-gray-400 text-sm">Comprobante No. #FP-{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</p>
                        </div>

                        <!-- Información Principal -->
                        <div class="space-y-6 border-y border-dashed border-gray-200 py-6 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400 text-sm font-medium">ESTADO</span>
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold {{ $pedido->estado == 'entregado' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ strtoupper($pedido->estado) }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400 text-sm font-medium">FECHA Y HORA</span>
                                <span class="text-gray-900 text-sm font-semibold">{{ $pedido->created_at->format('d/m/Y - H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400 text-sm font-medium">USUARIO</span>
                                <span class="text-gray-900 text-sm font-semibold">{{ auth()->user()->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400 text-sm font-medium">TIPO BENEFICIO</span>
                                <span class="text-gray-900 text-sm font-semibold">{{ $pedido->tipo == 'canje' ? 'Ayuda Alimentaria SENA' : 'Compra en Menú Digital' }}</span>
                            </div>
                        </div>

                        <!-- Resumen de Consumo -->
                        <div class="bg-gray-50 rounded-2xl p-5 mb-8">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-700 font-bold text-sm">Producto/Servicio</span>
                                <span class="text-gray-700 font-bold text-sm">Valor</span>
                            </div>
                            <div class="flex justify-between items-center text-sm mb-4">
                                <span class="text-gray-500 italic">{{ $pedido->detalle ?? 'Almuerzo Artesanal Completo' }}</span>
                                <span class="text-gray-900 font-medium">${{ number_format($pedido->total ?? 0, 2) }}</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3 flex justify-between items-center">
                                <span class="text-gray-900 font-extrabold">TOTAL</span>
                                <span class="text-[#F97F2D] font-black text-xl">${{ number_format($pedido->total ?? 0, 2) }}</span>
                            </div>
                            @if($pedido->tipo == 'canje')
                            <p class="text-[10px] text-gray-400 mt-2 text-center">* Cubierto por el beneficio de ayuda alimentaria.</p>
                            @endif
                        </div>

                        <!-- Botones de Acción -->
                        <div class="grid grid-cols-2 gap-4">
                            <button onclick="window.print()" class="flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-xl font-bold text-sm transition-colors">
                                <span class="material-symbols-outlined text-[18px]">print</span>
                                Imprimir
                            </button>
                            <button class="flex items-center justify-center gap-2 bg-[#F97F2D] hover:bg-[#e06d20] text-white py-3 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-orange-500/20">
                                <span class="material-symbols-outlined text-[18px]">share</span>
                                Compartir
                            </button>
                        </div>
                    </div>

                    <!-- Decoración inferior (Círculos laterales) -->
                    <div class="absolute bottom-16 -left-3 w-6 h-6 bg-[#f0ffd8] rounded-full"></div>
                    <div class="absolute bottom-16 -right-3 w-6 h-6 bg-[#f0ffd8] rounded-full"></div>
                </div>

                <p class="text-center text-gray-400 text-xs mt-8">FoodPass © 2024 - Todos los canjes están sujetos a los términos del programa SENA.</p>
            </div>
        </div>
    </main>
</body>
</html>