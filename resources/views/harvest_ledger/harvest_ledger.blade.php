<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FoodPass - Harvest Ledger</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: { extend: { colors: { "surface": "#f0ffd8", "on-surface": "#121f05", "surface-container-lowest": "#ffffff", "surface-container": "#e2f4c8", "primary": "#9b4500", "primary-container": "#f97f2d", "on-primary-container": "#5f2700", "on-surface-variant": "#574237", "outline-variant": "#dec1b2", "inverse-surface": "#273517" }, fontFamily: { "headline": ["Plus Jakarta Sans"], "body": ["Inter"] } } }
      }
    </script>
</head>
<body class="bg-surface text-on-surface min-h-screen p-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-3xl font-extrabold font-headline text-on-surface">Harvest Ledger</h1>
                <p class="text-on-surface-variant mt-1">Bienvenido, {{ $usuario->name }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-primary-container text-on-primary-container rounded-xl font-semibold text-sm">
                    Cerrar sesión
                </button>
            </form>
        </div>
        <div class="bg-surface-container-lowest rounded-2xl p-8 shadow-sm">
            <p class="text-on-surface-variant">Contenido del Harvest Ledger próximamente.</p>
        </div>
    </div>
</body>
</html>
