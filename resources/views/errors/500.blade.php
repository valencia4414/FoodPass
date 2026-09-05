<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error del Servidor - FoodPass</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2 { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f0ffd8] flex items-center justify-center h-screen">
    <div class="text-center p-8 bg-white rounded-3xl shadow-xl max-w-md w-full border border-gray-100 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-red-500 rounded-bl-[100px] opacity-10"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-[#273517] rounded-tr-[100px] opacity-10"></div>
        
        <div class="relative z-10">
            <span class="material-symbols-outlined text-[80px] text-red-500 mb-4">error</span>
            <h1 class="text-6xl font-extrabold text-[#273517] mb-2">500</h1>
            <h2 class="text-2xl font-bold text-gray-800 mb-3">Algo salió mal</h2>
            <p class="text-gray-500 mb-8 text-sm">Estamos trabajando para solucionarlo. Por favor, intenta de nuevo más tarde.</p>
            
            <div class="flex gap-4">
                <button onclick="window.location.reload()" class="flex-1 inline-flex items-center justify-center gap-2 bg-[#273517] hover:bg-[#1f2b12] text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-lg w-full text-sm">
                    <span class="material-symbols-outlined text-[18px]">refresh</span>
                    Recargar
                </button>
                <a href="{{ url('/') }}" class="flex-1 inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 px-4 rounded-xl transition-colors w-full text-sm">
                    Inicio
                </a>
            </div>
        </div>
    </div>
</body>
</html>
