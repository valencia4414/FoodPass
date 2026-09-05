<!DOCTYPE html>
<html class="light" lang="es">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FoodPass - Verificación OTP</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "surface": "#f0ffd8",
                    "surface-container-low": "#e8facd",
                    "on-primary-container": "#5f2700",
                    "primary": "#9b4500",
                    "surface-container": "#e2f4c8",
                    "background": "#f0ffd8",
                    "on-background": "#121f05",
                    "tertiary": "#006e16",
                    "error": "#ba1a1a",
                    "error-container": "#ffdad6",
                    "primary-container": "#f97f2d",
                    "inverse-surface": "#273517",
                    "surface-container-lowest": "#ffffff",
                    "on-surface-variant": "#574237",
                    "tertiary-container": "#4cb64b",
                    "outline-variant": "#dec1b2",
                    "on-surface": "#121f05",
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
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-headline { font-family: 'Plus Jakarta Sans', sans-serif; }
        .otp-digit {
            width: 3rem;
            height: 3.5rem;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 700;
            border-radius: 0.75rem;
            background: #e2f4c8;
            border: 2px solid transparent;
            outline: none;
            transition: border-color 0.15s;
        }
        .otp-digit:focus {
            border-color: #006e16;
            background: #ffffff;
        }
</style>
</head>
<body class="bg-surface text-on-surface min-h-screen flex items-center justify-center p-6 relative overflow-y-auto">
<div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
<div class="absolute -top-24 -left-24 w-96 h-96 bg-surface-container-low rounded-full blur-3xl opacity-50"></div>
<div class="absolute -bottom-24 -right-24 w-96 h-96 bg-primary-container/10 rounded-full blur-3xl opacity-40"></div>
</div>

<main class="w-full max-w-md relative z-10">
<div class="bg-surface-container-lowest rounded-[2rem] p-8 md:p-12 shadow-[0px_20px_40px_rgba(18,31,5,0.06)] border border-outline-variant/15">

    <div class="flex flex-col items-center mb-8">
        <div class="w-16 h-16 bg-surface-container-low rounded-2xl flex items-center justify-center mb-4 shadow-lg">
            <span class="material-symbols-outlined text-primary text-4xl">security</span>
        </div>
        <h1 class="text-2xl font-extrabold tracking-tight text-on-surface font-headline">Verificación de seguridad</h1>
        <p class="text-on-surface-variant font-medium mt-2 text-center text-sm">
            Enviamos un código de 6 dígitos a<br>
            <span class="text-primary font-bold">{{ $email ?? 'tu correo' }}</span>
        </p>
    </div>

    @if (session('status'))
        <div class="mb-4 p-3 rounded-xl bg-surface-container-low text-tertiary text-sm text-center font-medium">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-3 rounded-xl bg-error-container text-error text-sm text-center">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('otp.verify.post') }}" method="POST" id="otp-form" class="space-y-6">
        @csrf
        <input type="hidden" name="code" id="code-hidden" value="">

        <div class="flex justify-center gap-2" id="otp-inputs">
            @for ($i = 0; $i < 6; $i++)
                <input
                    type="text"
                    inputmode="numeric"
                    maxlength="1"
                    class="otp-digit"
                    data-index="{{ $i }}"
                    autocomplete="{{ $i === 0 ? 'one-time-code' : 'off' }}"
                    {{ $i === 0 ? 'autofocus' : '' }}
                />
            @endfor
        </div>

        <button
            type="submit"
            id="btn-verify"
            class="w-full bg-primary-container text-on-primary-container font-headline font-bold py-4 rounded-xl shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2 disabled:opacity-50"
        >
            Verificar código
            <span class="material-symbols-outlined text-lg">check_circle</span>
        </button>
    </form>

    <div class="mt-6 text-center space-y-3">
        <p class="text-sm text-on-surface-variant">¿No recibiste el código?</p>
        <form action="{{ route('otp.resend') }}" method="POST">
            @csrf
            <button type="submit" class="text-primary font-bold text-sm hover:underline">
                Reenviar código
            </button>
        </form>
        <a href="{{ route('login') }}" class="block text-on-surface-variant text-sm hover:text-primary mt-4">
            ← Volver al login
        </a>
    </div>
</div>
</main>

<script>
(function () {
    const inputs = Array.from(document.querySelectorAll('.otp-digit'));
    const hidden = document.getElementById('code-hidden');
    const form = document.getElementById('otp-form');

    function syncHidden() {
        hidden.value = inputs.map(i => i.value).join('');
    }

    inputs.forEach((input, idx) => {
        input.addEventListener('input', (e) => {
            const v = e.target.value.replace(/\D/g, '');
            e.target.value = v.slice(0, 1);
            if (v && idx < inputs.length - 1) {
                inputs[idx + 1].focus();
            }
            if (v.length > 1) {
                const chars = v.split('');
                chars.forEach((c, i) => {
                    if (idx + i < inputs.length) inputs[idx + i].value = c;
                });
                const next = Math.min(idx + chars.length, inputs.length - 1);
                inputs[next].focus();
            }
            syncHidden();
            if (inputs.every(i => i.value)) {
                form.submit();
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && idx > 0) {
                inputs[idx - 1].focus();
            }
        });

        input.addEventListener('paste', (e) => {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, 6);
            text.split('').forEach((c, i) => {
                if (inputs[i]) inputs[i].value = c;
            });
            syncHidden();
            if (text.length === 6) form.submit();
        });
    });

    form.addEventListener('submit', () => syncHidden());
})();
</script>
</body>
</html>