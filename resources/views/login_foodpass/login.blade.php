<!DOCTYPE html>

<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FoodPass - Acceso</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
        }
        h1, h2, h3, .font-headline {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen flex items-center justify-center p-6 relative overflow-y-auto">
<!-- Background Decoration (Artisanal Ledger Texture) -->
<div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
<div class="absolute -top-24 -left-24 w-96 h-96 bg-surface-container-high rounded-full blur-3xl opacity-50"></div>
<div class="absolute -bottom-24 -right-24 w-96 h-96 bg-primary-container/10 rounded-full blur-3xl opacity-40"></div>
</div>
<!-- Main Content Container -->
<main class="w-full max-w-md relative z-10">
<!-- Login Card -->
<div class="bg-surface-container-lowest rounded-[2rem] p-8 md:p-12 shadow-[0px_20px_40px_rgba(18,31,5,0.06)] border border-outline-variant/15">
<!-- Logo Section -->
<div class="flex flex-col items-center mb-10">
<div class="w-16 h-16 bg-inverse-surface rounded-2xl flex items-center justify-center mb-4 shadow-xl">
<span class="material-symbols-outlined text-primary-container text-4xl" data-icon="restaurant_menu">restaurant_menu</span>
</div>
<h1 class="text-3xl font-extrabold tracking-tight text-on-surface font-headline">FoodPass</h1>
<p class="text-on-surface-variant font-medium mt-1">The Artisanal Ledger</p>
</div>
<!-- Login Form -->
<form action="{{ route('login.post') }}" method="POST" class="space-y-6">
@csrf
{{-- Errores de autenticación --}}
@if ($errors->any())
<div class="mb-2 px-4 py-3 bg-error-container text-on-error-container rounded-xl text-sm font-semibold">
    {{ $errors->first() }}
</div>
@endif
<!-- Email Field -->
<div class="space-y-2">
<label class="block text-sm font-semibold text-on-surface ml-1 font-label uppercase tracking-widest text-[10px]" for="email">Email Address</label>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-on-surface-variant">
<span class="material-symbols-outlined text-[20px]" data-icon="mail">mail</span>
</div>
<input class="w-full pl-11 pr-4 py-4 bg-surface-container border-none rounded-xl focus:ring-2 focus:ring-tertiary transition-all outline-none text-on-surface placeholder:text-on-surface-variant/50 font-body" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required="" type="email"/>
</div>
</div>
<!-- Password Field -->
<div class="space-y-2">
<div class="flex justify-between items-center px-1">
<label class="block text-sm font-semibold text-on-surface font-label uppercase tracking-widest text-[10px]" for="password">Password</label>
<a class="text-[11px] font-bold text-primary hover:text-primary-container transition-colors font-label uppercase tracking-wider" href="#">Forgot?</a>
</div>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-on-surface-variant">
<span class="material-symbols-outlined text-[20px]" data-icon="lock">lock</span>
</div>
<input class="w-full pl-11 pr-12 py-4 bg-surface-container border-none rounded-xl focus:ring-2 focus:ring-tertiary transition-all outline-none text-on-surface placeholder:text-on-surface-variant/50 font-body" id="password" name="password" placeholder="••••••••" required="" type="password"/>
<button class="absolute inset-y-0 right-0 pr-4 flex items-center text-on-surface-variant hover:text-on-surface" type="button">
<span class="material-symbols-outlined text-[20px]" data-icon="visibility">visibility</span>
</button>
</div>
</div>
<!-- Primary CTA -->
<button class="w-full bg-primary-container text-on-primary-container font-headline font-bold py-4 rounded-xl shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2" type="submit">
<span>Entrar</span>
<span class="material-symbols-outlined text-[20px]" data-icon="arrow_forward">arrow_forward</span>
</button>
</form>
<!-- Divider -->
<div class="relative my-8">
<div class="absolute inset-0 flex items-center">
<div class="w-full h-[1px] bg-outline-variant/20"></div>
</div>
<div class="relative flex justify-center text-xs">
<span class="bg-surface-container-lowest px-4 text-on-surface-variant font-label uppercase tracking-[0.2em] font-medium">Or continue with</span>
</div>
</div>
<!-- Social Login -->
<div class="grid grid-cols-1 gap-4">
<button class="flex items-center justify-center gap-3 w-full py-4 px-4 bg-surface-container-low hover:bg-surface-container-high text-on-surface font-semibold rounded-xl border border-outline-variant/10 transition-colors duration-200" type="button">
<svg class="w-5 h-5" viewbox="0 0 24 24">
<path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
<path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
<path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"></path>
<path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
</svg>
<span class="font-body">Google</span>
</button>
</div>
<!-- Footer Link -->
<p class="text-center mt-10 text-on-surface-variant font-medium">
                ¿No tienes una cuenta? 
                <a class="text-primary font-bold hover:underline ml-1" href="{{ route('register') }}">Crear cuenta</a>
</p>
</div>
<!-- System Status Badges (Asymmetric Detail) -->
<div class="mt-8 flex justify-between items-center px-4">
<div class="flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-tertiary shadow-[0_0_8px_rgba(0,110,22,0.4)]"></span>
<span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">System Online</span>
</div>
<div class="flex items-center gap-3 opacity-40 hover:opacity-100 transition-opacity">
<span class="material-symbols-outlined text-sm" data-icon="verified_user">verified_user</span>
<span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">End-to-End Encrypted</span>
</div>
</div>
</main>
<!-- Side Decoration (Editorial Visual) -->
<div class="fixed top-1/2 -right-32 -translate-y-1/2 hidden xl:block w-[400px] h-[600px] pointer-events-none">
<div class="w-full h-full bg-surface-container-high rounded-[4rem] rotate-12 overflow-hidden shadow-2xl flex items-center justify-center p-8">
<div class="w-full h-full rounded-[3rem] bg-cover bg-center" data-alt="Close-up of fresh seasonal vegetables and artisan kitchen tools on a light wooden table with soft morning light" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAxfIw3D5by4XRt45IJFcWKshEP8HnQDbSV529DqwvNQDAt8XgVImgGSjui4Rv3JzZn7Cbeu7JUspvhh_cc06y9tGTHMSkkai5yQ-obNOTEIjTofC8hoRtr7xzXcUWwLoICGztaLLup_1QkStC3fbrOHLtxu7uqHx33b8TkClAj4WtyOl9cNne-ZXmJR7vqw78qORrk8ZeVN_TPpesv0y0DRvKlMsW2oOwhXBaqzDx8i5qnwpiYCtm2ZSpLG8xcdySoIeepT4UThoo')">
<div class="w-full h-full bg-gradient-to-t from-inverse-surface/60 to-transparent flex items-end p-12">
<div class="text-white">
<p class="font-headline text-2xl font-bold leading-tight">Master your kitchen inventory with artisanal precision.</p>
<div class="w-12 h-1 bg-primary-container mt-4"></div>
</div>
</div>
</div>
</div>
</div>
</body></html>