<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Métodos de Pago - FoodPass</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f0ffd8; }
        .sidebar-bg { background-color: #273517; }
    </style>
</head>
<body class="antialiased text-gray-800">
    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 w-56 sidebar-bg text-white flex flex-col z-20">
        <div class="p-6 flex items-center space-x-3">
            <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center font-bold text-lg">
                F
            </div>
            <div>
                <h1 class="font-bold text-lg leading-tight">FoodPass</h1>
                <p class="text-[10px] text-gray-400 tracking-wider">ARTISANAL LEDGER</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition-colors">
                <i class="fas fa-home w-5 text-center"></i>
                <span>Inicio</span>
            </a>
            <a href="{{ route('menu-digital') }}" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition-colors">
                <i class="fas fa-utensils w-5 text-center"></i>
                <span>Menú</span>
            </a>
            <a href="{{ route('historial') }}" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition-colors">
                <i class="fas fa-history w-5 text-center"></i>
                <span>Historial</span>
            </a>
            <a href="{{ route('canje') }}" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition-colors">
                <i class="fas fa-gift w-5 text-center"></i>
                <span>Canje</span>
            </a>
            <a href="{{ route('metodos-pago') }}" class="flex items-center space-x-3 px-4 py-3 text-sm text-white bg-orange-500 rounded-xl shadow-lg shadow-orange-500/20">
                <i class="fas fa-credit-card w-5 text-center"></i>
                <span class="font-medium">Pagos</span>
            </a>
            <a href="{{ route('perfil') }}" class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-white/10 rounded-xl transition-colors">
                <i class="fas fa-user w-5 text-center"></i>
                <span>Perfil</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10">
            <div class="flex items-center space-x-3 p-3 rounded-xl bg-white/5">
                <div class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold">
                    U
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">Usuario</p>
                    <p class="text-xs text-orange-400 truncate">Premium Member</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-56 min-h-screen">
        <!-- Header -->
        <header class="h-14 bg-white border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-10">
            <div class="relative w-96">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" placeholder="Buscar transacciones o tarjetas..." class="w-full pl-9 pr-4 py-1.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors">
            </div>
            
            <div class="flex items-center space-x-6">
                <div class="text-sm">
                    <span class="text-gray-500">Saldos:</span>
                    <span class="font-bold text-gray-900 ml-1">$1,240.00</span>
                </div>
                <button class="relative text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-bell"></i>
                    <span class="absolute -top-1 -right-1 w-2 h-2 bg-orange-500 rounded-full"></span>
                </button>
                <button class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-cog"></i>
                </button>
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-8 max-w-7xl mx-auto space-y-8">
            <!-- Page Header -->
            <div class="flex justify-between items-end">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Métodos de Pago</h1>
                    <p class="text-gray-500 text-sm mt-1 max-w-lg">Gestiona tus tarjetas, billeteras digitales y saldo FoodPass.<br>Toda tu información está protegida con encriptación de grado bancario.</p>
                </div>
                <button class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium flex items-center space-x-2 transition-colors shadow-lg shadow-orange-500/20">
                    <i class="fas fa-credit-card"></i>
                    <span>Nueva Tarjeta</span>
                </button>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Column (2 cols wide) -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- NEQUI Card -->
                    <div class="bg-gradient-to-r from-[#6200ea] to-[#8e24aa] rounded-2xl p-7 text-white shadow-xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3 blur-2xl"></div>
                        <div class="relative z-10 flex justify-between items-start">
                            <div>
                                <div class="flex items-center space-x-3 mb-8">
                                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                        <i class="fas fa-wallet text-xl"></i>
                                    </div>
                                    <h2 class="text-2xl font-bold tracking-wider">NEQUI</h2>
                                    <span class="px-2.5 py-1 text-xs font-medium bg-white/20 rounded-lg backdrop-blur-sm">VINCULADO</span>
                                </div>
                                <p class="text-sm text-white/80 font-medium uppercase tracking-wider mb-1">Saldo Disponible</p>
                                <h3 class="text-4xl font-bold tracking-tight">$450,200 COP</h3>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <button class="bg-white text-purple-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
                                    Recargar
                                </button>
                                <button type="button" onclick="openDeleteModal('NEQUI')" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                    Desvincular
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Saved Cards -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-6">Tarjetas Guardadas</h3>
                        
                        <div class="space-y-4">
                            <!-- Visa -->
                            <div class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:border-gray-200 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-[#1a1f71] rounded-lg flex items-center justify-center text-white font-bold italic text-lg shadow-inner">
                                        VISA
                                    </div>
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <p class="font-bold text-gray-900">Visa Infinite Gold</p>
                                            <span class="px-2 py-0.5 text-[10px] font-bold text-green-700 bg-green-100 rounded">PREDETERMINADA</span>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-0.5">Vence: 12/28 •••• 4242</p>
                                    </div>
                                </div>
                                <button type="button" onclick="openDeleteModal('Visa Infinite Gold')" class="text-gray-400 hover:text-red-500 p-2 transition-colors" title="Desvincular">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                            <div class="h-px w-full bg-gray-100"></div>

                            <!-- Mastercard -->
                            <div class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:border-gray-200 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gray-50 border border-gray-100 rounded-lg flex items-center justify-center relative overflow-hidden">
                                        <div class="w-6 h-6 bg-red-500 rounded-full absolute -ml-3 opacity-80 mix-blend-multiply"></div>
                                        <div class="w-6 h-6 bg-yellow-500 rounded-full absolute ml-3 opacity-80 mix-blend-multiply"></div>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900">Mastercard Corporate</p>
                                        <p class="text-sm text-gray-500 mt-0.5">Vence: 08/26 •••• 8812</p>
                                    </div>
                                </div>
                                <button type="button" onclick="openDeleteModal('Mastercard Corporate')" class="text-gray-400 hover:text-red-500 p-2 transition-colors" title="Desvincular">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                            <!-- Add new card -->
                            <button class="w-full flex items-center justify-center py-4 border-2 border-dashed border-gray-200 rounded-xl text-gray-500 hover:text-orange-500 hover:border-orange-500 hover:bg-orange-50 transition-all group">
                                <div class="flex items-center space-x-2 font-medium">
                                    <i class="fas fa-plus group-hover:scale-110 transition-transform"></i>
                                    <span>Vincular nuevo medio de pago</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Column (1 col wide) -->
                <div class="space-y-6">
                    
                    <!-- Security Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-shield-alt text-lg"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Seguridad FoodPass</h3>
                        <p class="text-sm text-gray-500 mb-4 leading-relaxed">Toda tu información bancaria está tokenizada. Cumplimos con los estándares PCI-DSS para garantizar que tus compras artesanales sean 100% seguras.</p>
                        <div class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-green-50 text-green-700 border border-green-200 rounded-full text-xs font-bold tracking-wide">
                            <i class="fas fa-lock"></i>
                            <span>ENCRIPTACIÓN 256-BIT</span>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-900">Actividad Reciente</h3>
                            <a href="#" class="text-sm font-medium text-orange-500 hover:text-orange-600">Ver todo</a>
                        </div>
                        
                        <div class="space-y-4">
                            <!-- Item 1 -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-50 text-green-600 rounded-full flex items-center justify-center shrink-0">
                                        <i class="fas fa-pizza-slice text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900 truncate max-w-[140px]">Pizzería La Formarina</p>
                                        <p class="text-xs text-gray-500">Hace 2 horas</p>
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-gray-900">-$12.50</span>
                            </div>
                            
                            <!-- Item 2 -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-50 text-green-600 rounded-full flex items-center justify-center shrink-0">
                                        <i class="fas fa-coffee text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900 truncate max-w-[140px]">Brew & Roast Co.</p>
                                        <p class="text-xs text-gray-500">Ayer, 09:15 AM</p>
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-gray-900">-$4.80</span>
                            </div>
                            
                            <!-- Item 3 -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center shrink-0">
                                        <i class="fas fa-wallet text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900 truncate max-w-[140px]">Recarga NEQUI</p>
                                        <p class="text-xs text-gray-500">24 Oct, 2023</p>
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-green-600">+$50.00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Artisan Plan -->
                    <div class="bg-[#273517] rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/3 blur-xl"></div>
                        <div class="relative z-10">
                            <span class="inline-block px-2.5 py-1 text-[10px] font-bold bg-white/20 rounded-md tracking-wider mb-4">PLAN ARTISAN</span>
                            <h3 class="text-xl font-bold mb-2">Ahorra un 15%</h3>
                            <p class="text-sm text-white/70 leading-relaxed">Con tu plan Artisan tienes envíos gratuitos y beneficios exclusivos en tus pagos.</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>

    <!-- Modal de confirmación para eliminar tarjeta (RF12) -->
    <div id="delete-modal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Eliminar Tarjeta
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    ¿Eliminar esta tarjeta? Esta acción no se puede deshacer.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="confirmDelete()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                        Confirmar
                    </button>
                    <button type="button" onclick="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Funciones para el Modal de Eliminación (RF12)
        const deleteModal = document.getElementById('delete-modal');
        let cardToDelete = null;

        function openDeleteModal(cardName) {
            cardToDelete = cardName;
            deleteModal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            cardToDelete = null;
            deleteModal.classList.add('hidden');
        }

        function confirmDelete() {
            // En una implementación real, aquí se enviaría la petición DELETE al backend.
            alert('Tarjeta ' + cardToDelete + ' eliminada exitosamente.');
            closeDeleteModal();
            // location.reload();
        }
    </script>
</body>
</html>