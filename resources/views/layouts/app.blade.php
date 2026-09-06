<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodPass')</title>
    <!-- Tailwind y Fuentes (RNF10 - Consistencia) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        /* Guía Visual (RNF10) */
        :root { --fp-orange: #F97F2D; --fp-dark: #273517; }
        body { background-color: #f0ffd8; font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="flex h-screen overflow-hidden">

    <!-- Sidebar Reutilizable (RNF06) -->
    @include('partials.sidebar')

    <div class="ml-64 flex-1 flex flex-col overflow-hidden">
        <!-- Header Reutilizable (RNF06) -->
        @include('partials.header')

        <!-- Notificaciones Toast (RF07) -->
        @include('partials.toast')

        <!-- Contenido Dinámico -->
        <main class="flex-1 overflow-y-auto p-4 md:p-8">
            @yield('content')
        </main>
    </div>

    <!-- Script Global para Spinners en botones (RNF07) -->
    <script>
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const btn = this.querySelector('button[type="submit"]');
                if (btn) {
                    btn.disabled = true;
                    btn.innerHTML = <span class="animate-spin mr-2">⏳</span> Procesando...;
                }
            });
        });
    </script>
</body>
</html>