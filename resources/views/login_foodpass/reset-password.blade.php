<!DOCTYPE html>
<html class="light" lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FoodPass - Restablecer contraseña</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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
<!-- Background Decoration -->
<div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
<div class="absolute -top-24 -left-24 w-96 h-96 bg-surface-container-high rounded-full blur-3xl opacity-50"></div>
<div class="absolute -bottom-24 -right-24 w-96 h-96 bg-primary-container/10 rounded-full blur-3xl opacity-40"></div>
</div>
<!-- Main Content Container -->
<main class="w-full max-w-md relative z-10">
<!-- Reset Password Card -->
<div class="bg-surface-container-lowest rounded-[2rem] p-8 md:p-12 shadow-[0px_20px_40px_rgba(18,31,5,0.06)] border border-outline-variant/15">
<!-- Logo Section -->
<div class="flex flex-col items-center mb-6">
<div class="w-16 h-16 bg-inverse-surface rounded-2xl flex items-center justify-center mb-4 shadow-xl">
<span class="material-symbols-outlined text-primary-container text-4xl">key</span>
</div>
<h1 class="text-3xl font-extrabold tracking-tight text-on-surface font-headline">FoodPass</h1>
<p class="text-on-surface-variant font-medium mt-1">Restablecer contraseña</p>
</div>

<p class="text-xs text-on-surface-variant text-center mb-6 leading-relaxed">
Crea una nueva contraseña segura para tu cuenta de FoodPass.
</p>

<!-- Validation Errors -->
@if ($errors->any())
<div class="mb-6 px-4 py-3 bg-error-container text-on-error-container border border-error/30 rounded-xl text-sm font-semibold flex items-center gap-2.5 shadow-sm">
    <span class="material-symbols-outlined text-lg shrink-0">error</span>
    <span>{{ $errors->first() }}</span>
</div>
@endif

<!-- Reset Password Form -->
<form action="{{ route('password.update') }}" method="POST" class="space-y-5" id="reset-form" novalidate>
@csrf

<input type="hidden" name="token" value="{{ $token ?? request()->route('token') }}"/>

<!-- Email Field -->
<div class="space-y-1.5">
<label class="block text-sm font-semibold text-on-surface ml-1 font-label uppercase tracking-widest text-[10px]" for="email">Correo electrónico</label>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-on-surface-variant">
<span class="material-symbols-outlined text-[20px]">mail</span>
</div>
<input class="w-full pl-11 pr-4 py-4 bg-surface-container border-2 border-transparent rounded-xl focus:ring-2 focus:ring-tertiary transition-all outline-none text-on-surface placeholder:text-on-surface-variant/50 font-body"
       id="email" name="email" placeholder="name@example.com" value="{{ old('email', $email ?? request()->email) }}" required type="email"/>
</div>
<p id="email-error" class="hidden text-xs text-error font-medium ml-1 mt-1 flex items-center gap-1">
  <span class="material-symbols-outlined text-[16px]">error</span>
  <span class="error-msg"></span>
</p>
</div>

<!-- Password Field -->
<div class="space-y-1.5">
<label class="block text-sm font-semibold text-on-surface ml-1 font-label uppercase tracking-widest text-[10px]" for="password">Nueva contraseña</label>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-on-surface-variant">
<span class="material-symbols-outlined text-[20px]">lock</span>
</div>
<input class="w-full pl-11 pr-12 py-4 bg-surface-container border-2 border-transparent rounded-xl focus:ring-2 focus:ring-tertiary transition-all outline-none text-on-surface placeholder:text-on-surface-variant/50 font-body"
       id="password" name="password" placeholder="Mínimo 8 caracteres" required type="password"/>
<button class="absolute inset-y-0 right-0 pr-4 flex items-center text-on-surface-variant hover:text-on-surface" type="button"
        onclick="togglePassword('password', this)">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
</div>
<p id="password-error" class="hidden text-xs text-error font-medium ml-1 mt-1 flex items-center gap-1">
  <span class="material-symbols-outlined text-[16px]">error</span>
  <span class="error-msg"></span>
</p>
</div>

<!-- Confirm Password Field -->
<div class="space-y-1.5">
<label class="block text-sm font-semibold text-on-surface ml-1 font-label uppercase tracking-widest text-[10px]" for="password_confirmation">Confirmar nueva contraseña</label>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-on-surface-variant">
<span class="material-symbols-outlined text-[20px]">lock_reset</span>
</div>
<input class="w-full pl-11 pr-12 py-4 bg-surface-container border-2 border-transparent rounded-xl focus:ring-2 focus:ring-tertiary transition-all outline-none text-on-surface placeholder:text-on-surface-variant/50 font-body"
       id="password_confirmation" name="password_confirmation" placeholder="Repite tu nueva contraseña" required type="password"/>
<button class="absolute inset-y-0 right-0 pr-4 flex items-center text-on-surface-variant hover:text-on-surface" type="button"
        onclick="togglePassword('password_confirmation', this)">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
</div>
<p id="password_confirmation-error" class="hidden text-xs text-error font-medium ml-1 mt-1 flex items-center gap-1">
  <span class="material-symbols-outlined text-[16px]">error</span>
  <span class="error-msg"></span>
</p>
</div>

<!-- Submit Button -->
<button id="reset-btn" class="w-full bg-primary-container text-on-primary-container font-headline font-bold py-4 rounded-xl shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2 mt-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 disabled:pointer-events-none" type="submit" disabled>
<span id="btn-text">Guardar nueva contraseña</span>
<span id="btn-icon" class="material-symbols-outlined text-[20px]">check_circle</span>
<svg id="btn-spinner" class="hidden animate-spin h-5 w-5 text-on-primary-container" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
</svg>
</button>
</form>

<!-- Footer Link -->
<p class="text-center mt-8 text-on-surface-variant font-medium text-sm">
    ¿Recordaste tu contraseña?
    <a class="text-primary font-bold hover:underline ml-1" href="{{ route('login') }}">Iniciar sesión</a>
</p>
</div>

<!-- System Status Badges -->
<div class="mt-8 flex justify-between items-center px-4">
<div class="flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-tertiary shadow-[0_0_8px_rgba(0,110,22,0.4)]"></span>
<span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">System Online</span>
</div>
<div class="flex items-center gap-3 opacity-40 hover:opacity-100 transition-opacity">
<span class="material-symbols-outlined text-sm">verified_user</span>
<span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">End-to-End Encrypted</span>
</div>
</div>
</main>

<script>
function togglePassword(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const icon  = btn.querySelector('.material-symbols-outlined');
    if (!input || !icon) return;
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'visibility_off';
    } else {
        input.type = 'password';
        icon.textContent = 'visibility';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('reset-form');
    const submitBtn = document.getElementById('reset-btn');
    const btnText = document.getElementById('btn-text');
    const btnIcon = document.getElementById('btn-icon');
    const btnSpinner = document.getElementById('btn-spinner');

    if (!form || !submitBtn) return;

    const fields = {
        email: {
            input: document.getElementById('email'),
            error: document.getElementById('email-error'),
            touched: false,
            validate: (val) => {
                if (!val.trim()) return 'El campo está vacío.';
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(val.trim())) return 'El email tiene formato inválido.';
                return '';
            }
        },
        password: {
            input: document.getElementById('password'),
            error: document.getElementById('password-error'),
            touched: false,
            validate: (val) => {
                if (!val) return 'El campo está vacío.';
                if (val.length < 8) return 'La contraseña debe tener al menos 8 caracteres.';
                return '';
            }
        },
        password_confirmation: {
            input: document.getElementById('password_confirmation'),
            error: document.getElementById('password_confirmation-error'),
            touched: false,
            validate: (val) => {
                if (!val) return 'El campo está vacío.';
                if (fields.password && fields.password.input && val !== fields.password.input.value) {
                    return 'Las contraseñas no coinciden.';
                }
                return '';
            }
        }
    };

    function updateFieldStatus(key) {
        const field = fields[key];
        if (!field || !field.input || !field.error) return true;

        const val = field.input.value;
        const errorMsg = field.validate(val);
        const hasError = errorMsg !== '';

        if (field.touched) {
            const errorMsgEl = field.error.querySelector('.error-msg');
            if (hasError) {
                field.input.classList.add('!border-error', '!focus:ring-error');
                field.input.classList.remove('border-transparent');
                if (errorMsgEl) errorMsgEl.textContent = errorMsg;
                field.error.classList.remove('hidden');
            } else {
                field.input.classList.remove('!border-error', '!focus:ring-error');
                field.input.classList.add('border-transparent');
                if (errorMsgEl) errorMsgEl.textContent = '';
                field.error.classList.add('hidden');
            }
        }

        return !hasError;
    }

    function checkFormValidity() {
        let isFormValid = true;

        Object.keys(fields).forEach(key => {
            const field = fields[key];
            if (!field.input) return;
            const errorMsg = field.validate(field.input.value);
            if (errorMsg !== '') {
                isFormValid = false;
            }
        });

        if (isFormValid) {
            submitBtn.removeAttribute('disabled');
        } else {
            submitBtn.setAttribute('disabled', 'disabled');
        }
    }

    Object.keys(fields).forEach(key => {
        const field = fields[key];
        if (!field.input) return;

        field.input.addEventListener('input', () => {
            field.touched = true;
            updateFieldStatus(key);

            if (key === 'password' && fields.password_confirmation && fields.password_confirmation.touched) {
                updateFieldStatus('password_confirmation');
            }

            checkFormValidity();
        });

        field.input.addEventListener('blur', () => {
            field.touched = true;
            updateFieldStatus(key);
            checkFormValidity();
        });
    });

    form.addEventListener('submit', (e) => {
        let allValid = true;

        Object.keys(fields).forEach(key => {
            const field = fields[key];
            if (field.input) {
                field.touched = true;
                const isValid = updateFieldStatus(key);
                if (!isValid) allValid = false;
            }
        });

        checkFormValidity();

        if (!allValid) {
            e.preventDefault();
            return;
        }

        submitBtn.setAttribute('disabled', 'disabled');
        if (btnText) btnText.textContent = 'Guardando...';
        if (btnIcon) btnIcon.classList.add('hidden');
        if (btnSpinner) btnSpinner.classList.remove('hidden');
    });

    Object.keys(fields).forEach(key => {
        const field = fields[key];
        if (field.input && field.input.value.trim() !== '') {
            field.touched = true;
            updateFieldStatus(key);
        }
    });

    checkFormValidity();
});
</script>
</body>
</html>
