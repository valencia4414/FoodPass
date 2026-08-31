<!DOCTYPE html>

<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "on-tertiary-fixed": "#002203",
                    "on-tertiary": "#ffffff",
                    "surface-container-high": "#dcefc3",
                    "surface": "#f0ffd8",
                    "surface-container-low": "#e8facd",
                    "on-primary-container": "#5f2700",
                    "primary": "#9b4500",
                    "on-primary": "#ffffff",
                    "surface-container": "#e2f4c8",
                    "primary-fixed": "#ffdbc9",
                    "background": "#f0ffd8",
                    "on-secondary-container": "#682800",
                    "on-background": "#121f05",
                    "tertiary-fixed-dim": "#73dd6d",
                    "tertiary": "#006e16",
                    "error": "#ba1a1a",
                    "on-secondary-fixed": "#341000",
                    "error-container": "#ffdad6",
                    "secondary-fixed": "#ffdbcb",
                    "primary-fixed-dim": "#ffb68e",
                    "primary-container": "#f97f2d",
                    "tertiary-fixed": "#8ffb86",
                    "on-error-container": "#93000a",
                    "inverse-on-surface": "#e5f7cb",
                    "surface-container-highest": "#d7e9bd",
                    "inverse-surface": "#273517",
                    "surface-dim": "#cee0b5",
                    "secondary-fixed-dim": "#ffb693",
                    "on-secondary": "#ffffff",
                    "outline": "#8b7265",
                    "on-secondary-fixed-variant": "#7a3000",
                    "surface-container-lowest": "#ffffff",
                    "on-tertiary-fixed-variant": "#00530e",
                    "on-error": "#ffffff",
                    "on-primary-fixed-variant": "#763300",
                    "inverse-primary": "#ffb68e",
                    "surface-bright": "#f0ffd8",
                    "secondary-container": "#fd8544",
                    "surface-tint": "#9b4500",
                    "on-surface-variant": "#574237",
                    "tertiary-container": "#4cb64b",
                    "outline-variant": "#dec1b2",
                    "secondary": "#a04100",
                    "surface-variant": "#d7e9bd",
                    "on-surface": "#121f05",
                    "on-tertiary-container": "#004209",
                    "on-primary-fixed": "#331200"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "fontFamily": {
                    "headline": ["Plus Jakarta Sans"],
                    "body": ["Inter"],
                    "label": ["Inter"]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0ffd8;
            color: #121f05;
        }
        h1, h2, h3, .font-headline {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-surface text-on-background">
<!-- SideNavBar Shell -->
<aside class="hidden lg:flex flex-col z-40 h-screen w-64 fixed left-0 top-0 overflow-y-auto bg-[#273517] dark:bg-[#121f05] shadow-2xl font-['Plus_Jakarta_Sans'] tracking-wide">
<div class="p-8">
<h1 class="text-2xl font-bold text-white mb-1">FoodPass</h1>
<p class="text-white/50 text-xs uppercase tracking-widest font-bold">The Artisanal Ledger</p>
</div>
<nav class="flex-1 px-4 space-y-2">
<!-- Active State: Inicio -->
<a class="flex items-center gap-3 bg-[#F97F2D] text-white rounded-full px-4 py-3 mx-2 active:scale-95 transition-all duration-200" href="{{ route('dashboard') }}">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">home</span>
<span class="font-semibold">Inicio</span>
</a>
<a class="flex items-center gap-3 text-white/70 hover:text-white hover:bg-white/10 px-4 py-3 mx-2 rounded-full transition-all duration-200" href="{{ route('menu-digital') }}">
<span class="material-symbols-outlined">restaurant_menu</span>
<span class="font-semibold">Menú</span>
</a>
<a class="flex items-center gap-3 text-white/70 hover:text-white hover:bg-white/10 px-4 py-3 mx-2 rounded-full transition-all duration-200" href="{{ route('historial') }}">
<span class="material-symbols-outlined">history</span>
<span class="font-semibold">Historial</span>
</a>
<a class="flex items-center gap-3 text-white/70 hover:text-white hover:bg-white/10 px-4 py-3 mx-2 rounded-full transition-all duration-200" href="{{ route('canje') }}">
<span class="material-symbols-outlined">qr_code_scanner</span>
<span class="font-semibold">Canje</span>
</a>
<a class="flex items-center gap-3 text-white/70 hover:text-white hover:bg-white/10 px-4 py-3 mx-2 rounded-full transition-all duration-200" href="{{ route('metodos-pago') }}">
<span class="material-symbols-outlined">payments</span>
<span class="font-semibold">Pagos</span>
</a>
<a class="flex items-center gap-3 text-white/70 hover:text-white hover:bg-white/10 px-4 py-3 mx-2 rounded-full transition-all duration-200" href="{{ route('perfil') }}">
<span class="material-symbols-outlined">person</span>
<span class="font-semibold">Perfil</span>
</a>
</nav>
<div class="mt-auto p-6 border-t border-white/5">
<div class="flex items-center gap-3 px-2 py-3 rounded-xl bg-white/5">
<img alt="User avatar" class="w-10 h-10 rounded-full bg-white/10" data-alt="close-up portrait of a professional chef smiling in a sunlit artisanal kitchen setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCK2kvhmJRqp5doaqOjTkpHFjMq2Ymks740ZRok0JSFoTW0HlxUzQ7-tCv60Vz8SP4Y20iDN7tmI_sRgXY1ZaU6Xuar7aODMQDJk0grTzJOBvOHWoEZJCpvfQwXlUOwJjhyatytrc-Dht6bIgW_oUzkLew64OE9WuJMK1nXWwy6iB8BmG2Xslyuor4aW06wxf0MDuEQ6xbq0ewpJJaXwCX4e1uqS_GmpNczkEBfccYDyvBuXH4fH7SX9IEhluDVNcUfNpiP6XH5z9o"/>
<div class="overflow-hidden">
<p class="text-white font-bold truncate">{{ auth()->user()->name }}</p>
<p class="text-white/40 text-xs truncate">Premium Member</p>
</div>
</div>
</div>
</aside>
<!-- TopNavBar Shell -->
<header class="fixed top-0 right-0 w-full lg:w-[calc(100%-16rem)] h-16 z-30 bg-white/80 dark:bg-[#121f05]/80 backdrop-blur-md shadow-[0px_20px_40px_rgba(18,31,5,0.06)] flex justify-between items-center px-6 transition-colors duration-300">
<div class="flex items-center gap-4 flex-1">
<div class="lg:hidden text-lg font-bold text-[#273517] dark:text-white">FoodPass</div>
<div class="hidden lg:flex items-center bg-surface-container px-4 py-2 rounded-full w-96 max-w-md">
<span class="material-symbols-outlined text-outline" data-icon="search">search</span>
<input class="bg-transparent border-none focus:ring-0 text-sm w-full font-label placeholder:text-outline" placeholder="Buscar pedidos o facturas..." type="text"/>
</div>
</div>
<div class="flex items-center gap-6">
<button class="relative p-2 text-on-background hover:bg-gray-50 rounded-full transition-colors">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-primary-container rounded-full"></span>
</button>
<div class="flex items-center gap-3">
<span class="hidden md:block font-['Plus_Jakarta_Sans'] font-semibold text-on-background">{{ auth()->user()->name }}</span>
<div class="w-8 h-8 rounded-full bg-surface-container-highest overflow-hidden">
<img alt="User Profile" data-alt="profile photo of a young adult male with a friendly expression in high-quality professional lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDuch-4jPeslYZY_jTtjGhunCaWFMUU2R3KGeqH0c0kboLhR1HtcmNhw_W1PkDVbdrrlKXPLBYkPYe9NbQVRLu5PUn8xv3SPrXe9V0en7DggcpYCLsQKToOdX05D4RRXjnn7u-5P9ufiEPjxucTJgL_w_gnUUbC04zfeFp-2896ch2qxJVK1xkrJVw6e56tVNbQ9o8JqocqDLG98Jzk6_SN9M3S-IciNPOZltJhrQ3Drc8vjmLtDoEet1FkW9FOsqiVASO1RqGMhrU"/>
</div>
</div>
</div>
</header>
<!-- Main Content Canvas -->
<main class="lg:ml-64 pt-24 px-6 pb-12 min-h-screen">
<!-- Welcome Section -->
<section class="mb-10">
<h2 class="text-4xl font-headline font-extrabold text-on-background tracking-tight mb-2">¡Hola, {{ explode(' ', auth()->user()->name)[0] }}!</h2>
<p class="text-on-surface-variant font-body">Bienvenido a tu panel artesanal de hoy.</p>
</section>
<!-- Bento Grid Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-12">
<!-- Principal Card: Almuerzos Disponibles -->
<div class="md:col-span-8 bg-surface-container-lowest rounded-[2rem] p-8 shadow-[0px_20px_40px_rgba(18,31,5,0.04)] relative overflow-hidden group">
<div class="relative z-10 flex flex-col h-full justify-between">
<div>
<span class="bg-tertiary-container text-on-tertiary-container text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-6 inline-block">Plan Premium</span>
<h3 class="text-on-background text-2xl font-headline font-bold mb-1">Almuerzos disponibles</h3>
<p class="text-on-surface-variant mb-8">Consumos restantes de tu ciclo mensual</p>
</div>
<div class="flex items-end gap-4">
<span class="text-7xl font-headline font-extrabold text-primary-container tracking-tighter">14</span>
<span class="text-on-surface-variant text-xl font-headline font-semibold pb-2">/ 22 días</span>
</div>
</div>
<!-- Abstract Decorative Element -->
<div class="absolute -right-16 -bottom-16 w-64 h-64 bg-surface-container-high rounded-full opacity-20 group-hover:scale-110 transition-transform duration-500"></div>
<div class="absolute right-8 top-8">
<span class="material-symbols-outlined text-primary-container text-6xl opacity-20" data-icon="restaurant" style="font-variation-settings: 'FILL' 1;">restaurant</span>
</div>
</div>
<!-- Stats Side Cards -->
<div class="md:col-span-4 flex flex-col gap-6">
<!-- Pedidos Realizados -->
<div class="bg-surface-container-low rounded-[2rem] p-6 flex flex-col justify-between h-full">
<div class="flex justify-between items-start">
<div class="w-12 h-12 bg-surface-container-lowest rounded-2xl flex items-center justify-center">
<span class="material-symbols-outlined text-primary" data-icon="shopping_bag">shopping_bag</span>
</div>
<span class="text-xs font-bold text-tertiary">+2 esta semana</span>
</div>
<div>
<p class="text-on-surface-variant text-sm font-semibold uppercase tracking-wider mb-1">Pedidos realizados</p>
<p class="text-3xl font-headline font-extrabold text-on-background">48</p>
</div>
</div>
<!-- Estado de Cuenta -->
<div class="bg-inverse-surface rounded-[2rem] p-6 text-white flex flex-col justify-between h-full">
<div class="flex justify-between items-start">
<div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center">
<span class="material-symbols-outlined text-primary-container" data-icon="account_balance_wallet" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
</div>
<button class="text-white/40 hover:text-white transition-colors">
<span class="material-symbols-outlined" data-icon="arrow_forward_ios">arrow_forward_ios</span>
</button>
</div>
<div>
<p class="text-white/60 text-sm font-semibold uppercase tracking-wider mb-1">Estado de cuenta</p>
<p class="text-2xl font-headline font-bold">$12.450,00</p>
</div>
</div>
</div>
</div>
<!-- Asymmetric Section: Recent Activity & Featured Menu -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
<!-- Activity Ledger (2/3 width) -->
<div class="lg:col-span-2">
<div class="flex items-center justify-between mb-6 px-2">
<h4 class="text-xl font-headline font-bold text-on-background">Historial de Consumo</h4>
<a class="text-primary font-semibold text-sm hover:underline" href="#">Ver todo</a>
</div>
<div class="bg-surface-container-lowest rounded-[2rem] overflow-hidden">
<div class="p-6 flex items-center gap-4 hover:bg-surface-container-low transition-colors duration-200">
<div class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-on-surface" data-icon="skillet">skillet</span>
</div>
<div class="flex-1">
<p class="font-headline font-bold text-on-background">Lasaña de Berenjenas</p>
<p class="text-sm text-on-surface-variant">Restaurante "La Toscana"</p>
</div>
<div class="text-right">
<p class="font-headline font-bold text-on-background">-1</p>
<p class="text-xs text-on-surface-variant">Hoy, 12:45 PM</p>
</div>
</div>
<div class="mx-6 h-0.5 bg-surface-container-high/50"></div>
<div class="p-6 flex items-center gap-4 hover:bg-surface-container-low transition-colors duration-200">
<div class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-on-surface" data-icon="bakery_dining">bakery_dining</span>
</div>
<div class="flex-1">
<p class="font-headline font-bold text-on-background">Combo Desayuno Artesanal</p>
<p class="text-sm text-on-surface-variant">Café del Parque</p>
</div>
<div class="text-right">
<p class="font-headline font-bold text-on-background">-1</p>
<p class="text-xs text-on-surface-variant">Ayer, 09:15 AM</p>
</div>
</div>
<div class="mx-6 h-0.5 bg-surface-container-high/50"></div>
<div class="p-6 flex items-center gap-4 hover:bg-surface-container-low transition-colors duration-200">
<div class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-on-surface" data-icon="local_drink">local_drink</span>
</div>
<div class="flex-1">
<p class="font-headline font-bold text-on-background">Recarga de Saldo</p>
<p class="text-sm text-on-surface-variant">Pago con Tarjeta *4421</p>
</div>
<div class="text-right">
<p class="font-headline font-bold text-tertiary">+$15.000</p>
<p class="text-xs text-on-surface-variant">12 Oct, 04:30 PM</p>
</div>
</div>
</div>
</div>
<!-- Featured "Freshness" Section (1/3 width) -->
<div class="lg:col-span-1">
<div class="mb-6 px-2">
<h4 class="text-xl font-headline font-bold text-on-background">Sugerencia del día</h4>
</div>
<div class="bg-surface-container-low rounded-[2rem] p-2 flex flex-col gap-4">
<div class="relative h-48 w-full rounded-[1.8rem] overflow-hidden">
<img alt="Salad plate" class="w-full h-full object-cover" data-alt="vibrant gourmet salad bowl with fresh greens, grilled salmon, and citrus dressing on a rustic wooden table" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDRWCPCR71-81hVJoJQNPsDw8JWjVlr3C0npYS9FYvAqt4ZG4W8uaeugKrVmWwH07UgP49TZAhXI5mQ-vrtjgkcJFd9i3cp241m6tCMe1JeCNdCglkT-8APsxY1cwe9p2_I1YjIyqFa9bBKxZ1YoKhO8JuaucCI6spc3JvlMn6XzcqDYAdcEXlR3KQOuZLa_8HFoVWmMXJ9mPsD2rOh8eIKwnnmkAXJJ522njLHGM9YFDtRjT2A2bADxIRYbDOS_X7UKLKMIGVCYkg"/>
<div class="absolute top-4 left-4">
<span class="bg-tertiary-container text-on-tertiary-container text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">En Stock</span>
</div>
</div>
<div class="px-4 pb-6 pt-2">
<h5 class="text-lg font-headline font-bold text-on-background mb-1">Poke Bowl de Salmón</h5>
<p class="text-sm text-on-surface-variant mb-6 leading-relaxed">Arroz integral, aguacate fresco y edamame con aderezo cítrico.</p>
<button class="w-full bg-primary-container text-on-primary-container font-headline font-bold py-4 rounded-2xl hover:scale-[1.02] active:scale-95 transition-all shadow-lg shadow-primary-container/10">
                            Pedir ahora
                        </button>
</div>
</div>
</div>
</div>
</main>
<!-- Floating Action Button - Only for Dashboard Context -->
<button class="fixed bottom-8 right-8 w-16 h-16 bg-primary-container text-on-primary-container rounded-full shadow-[0px_20px_40px_rgba(18,31,5,0.2)] flex items-center justify-center group hover:scale-110 active:scale-95 transition-all z-50">
<span class="material-symbols-outlined text-3xl" data-icon="qr_code_2">qr_code_2</span>
<div class="absolute right-full mr-4 bg-inverse-surface text-white text-sm font-bold py-2 px-4 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
            Escanear para Canje
        </div>
</button>
</body></html>