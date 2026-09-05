<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\MetodosPagoController;
use App\Http\Controllers\MenuDigitalController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CanjeController;
use App\Http\Controllers\HarvestLedgerController;
use App\Http\Controllers\PlatilloController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\PagoController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Redirigir raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas públicas (solo para no autenticados)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.post');

    Route::get('/register', [RegisterController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.post');
        
            // RF21 — Verificación OTP (MFA para admins)
    Route::get('/otp/verify', [OtpController::class, 'show'])
        ->name('otp.verify');
    Route::post('/otp/verify', [OtpController::class, 'verify'])
        ->name('otp.verify.post');
    Route::post('/otp/resend', [OtpController::class, 'resend'])
        ->name('otp.resend');

    // --- Rutas públicas de Recuperación de Contraseña ---
    Route::get('/forgot-password', function () {
        if (view()->exists('login_foodpass.forgot-password')) {
            return view('login_foodpass.forgot-password');
        }
        return view('auth.forgot-password');
    })->name('password.request');

<<<<<<< HEAD
    Route::post('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'store'])
        ->name('password.email');

    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'update'])
        ->name('password.update');
=======
    Route::post('/forgot-password', function (Request $request) {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email'    => 'El email tiene formato inválido.',
        ]);

        return back()->with('status', 'Te enviamos un enlace a tu correo.');
    })->name('password.email');

    Route::get('/reset-password/{token}', function (Request $request, $token) {
        if (view()->exists('login_foodpass.reset-password')) {
            return view('login_foodpass.reset-password', ['token' => $token, 'email' => $request->email]);
        }
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    })->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token'                 => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|confirmed|min:8',
        ], [
            'email.required'        => 'El correo electrónico es obligatorio.',
            'email.email'           => 'El email tiene formato inválido.',
            'password.required'     => 'La nueva contraseña es obligatoria.',
            'password.min'          => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed'    => 'Las contraseñas no coinciden.',
        ]);

        return redirect()->route('login')->with('status', 'Tu contraseña ha sido restablecida exitosamente.');
    })->name('password.update');
>>>>>>> acab2ef7ff501e8ec4cc1a538a5222850f87a411
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('/privacidad', function () {
    return view('privacidad');
})->name('privacidad');

// Rutas protegidas
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // --- RF05: Historial ---
    Route::get('/historial', [HistorialController::class, 'index'])
        ->name('historial');

    Route::get('/historial/{id}', [HistorialController::class, 'show'])
        ->name('historial.show');

    // Métodos de pago
    Route::get('/metodos-pago', [MetodosPagoController::class, 'index'])
        ->name('metodos-pago');

    // Menú digital
    Route::get('/menu-digital', [MenuDigitalController::class, 'index'])
        ->name('menu-digital');

    Route::post('/menu-digital/pedido', [PedidoController::class, 'storeWeb'])
        ->name('pedido.store.web');

    // Perfil
    Route::get('/perfil', [PerfilController::class, 'index'])
        ->name('perfil');

    Route::put('/perfil', [PerfilController::class, 'update'])
        ->name('perfil.update');

    Route::delete('/usuarios/mi-cuenta', [CuentaController::class, 'destroy'])
        ->name('cuenta.destroy');

    // --- RF04: Canje y Beneficio SENA ---
    Route::middleware(['role:beneficiario,admin', 'throttle:foodpass'])->group(function () {

        Route::get('/canje', [CanjeController::class, 'index'])
            ->name('canje');

        Route::post('/canje', [CanjeController::class, 'store'])
            ->name('canje.store');
    });

    // Harvest Ledger
    Route::get('/harvest-ledger', [HarvestLedgerController::class, 'index'])
        ->name('harvest-ledger');

    // --- Tareas 103-105: Módulo de Soporte (Tickets) ---
    Route::get('/soporte', [TicketController::class, 'index'])
        ->name('soporte.index');

    Route::post('/soporte', [TicketController::class, 'store'])
        ->name('soporte.store');

    Route::get('/soporte/{id}', [TicketController::class, 'show'])
        ->name('soporte.show');

    Route::post('/soporte/{id}/responder', [TicketController::class, 'responder'])
        ->name('soporte.responder');

    Route::patch('/soporte/{id}/estado', [TicketController::class, 'cambiarEstado'])
        ->name('soporte.estado');

    // --- Tarea 108: Rutas de Verificación de Correo ---
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/dashboard')
            ->with('success', '¡Correo verificado con éxito!');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with(
            'message',
            '¡Te hemos enviado un nuevo enlace de verificación!'
        );
    })->middleware('throttle:6,1')->name('verification.send');

    // ── RF04/RF05/RF06 – Administración de Restaurantes y Platillos ──
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:admin,restaurante,operador_restaurante')
        ->group(function () {

            // CRUD Restaurantes
            Route::resource('restaurantes', RestauranteController::class);

            // CRUD Platillos
            Route::resource('platillos', PlatilloController::class);

            // RF06 – Toggle disponibilidad
            Route::patch(
                'platillos/{platillo}/disponibilidad',
                [PlatilloController::class, 'toggleDisponibilidad']
            )->name('platillos.disponibilidad');
        });

    // RF07, RF08, RF09: Pedidos
    Route::middleware('auth:sanctum')->group(function () {

        Route::middleware('throttle:foodpass')->group(function () {

            Route::get('/pedidos', [PedidoController::class, 'index']);

            Route::post('/pedidos', [PedidoController::class, 'store']);

            Route::get('/pedidos/{id}', [PedidoController::class, 'show']);

            Route::patch('/pedidos/{id}/estado', [PedidoController::class, 'update']);

            Route::post('/pagos', [PagoController::class, 'store'])
                ->name('pagos.store');
        });
    });

    // Carrito de Pedidos (Tarea 14)
    Route::get('/cart', [CartController::class, 'show'])
        ->name('cart.show');

    Route::post('/cart/add', [CartController::class, 'add'])
        ->name('cart.add');

    Route::post('/cart/update', [CartController::class, 'update'])
        ->name('cart.update');

    Route::post('/cart/remove', [CartController::class, 'remove'])
        ->name('cart.remove');
});
