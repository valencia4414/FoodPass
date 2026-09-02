<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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
    Route::get('/login',     [LoginController::class,   'showLogin'])->name('login');
    Route::post('/login',    [LoginController::class,   'login'])->name('login.post');
    Route::get('/register',  [RegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

    // --- Tarea 106: Rutas públicas de Recuperación de Contraseña ---
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/privacidad', function () {
    return view('privacidad');
})->name('privacidad');

// Rutas protegidas
Route::middleware('auth')->group(function () {
    Route::get('/dashboard',      [DashboardController::class,    'index'])->name('dashboard');

    // --- RF05: Historial ---
    Route::get('/historial',      [HistorialController::class,    'index'])->name('historial');
    Route::get('/historial/{id}', [HistorialController::class,    'show'])->name('historial.show'); // Detalle del pedido

    Route::get('/metodos-pago',   [MetodosPagoController::class,  'index'])->name('metodos-pago');
    Route::get('/menu-digital',   [MenuDigitalController::class,  'index'])->name('menu-digital');
    Route::get('/perfil',         [PerfilController::class,       'index'])->name('perfil');
    Route::put('/perfil',         [PerfilController::class,       'update'])->name('perfil.update');
    Route::delete('/usuarios/mi-cuenta', [CuentaController::class, 'destroy'])->name('cuenta.destroy');

    // --- RF04: Canje y Beneficio SENA ---
    Route::middleware(['role:beneficiario,admin', 'throttle:foodpass'])->group(function () {
        Route::get('/canje',          [CanjeController::class,        'index'])->name('canje');
        Route::post('/canje',         [CanjeController::class,        'store'])->name('canje.store'); // Para procesar el canje
    });

    Route::get('/harvest-ledger', [HarvestLedgerController::class, 'index'])->name('harvest-ledger');

    // --- Tareas 103-105: Módulo de Soporte (Tickets) ---
    Route::get('/soporte', [TicketController::class, 'index'])->name('soporte.index');
    Route::post('/soporte', [TicketController::class, 'store'])->name('soporte.store');
    Route::get('/soporte/{id}', [TicketController::class, 'show'])->name('soporte.show');
    Route::post('/soporte/{id}/responder', [TicketController::class, 'responder'])->name('soporte.responder');
    Route::patch('/soporte/{id}/estado', [TicketController::class, 'cambiarEstado'])->name('soporte.estado');

    // --- Tarea 108: Rutas de Verificación de Correo ---
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard')->with('success', '¡Correo verificado con éxito!');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', '¡Te hemos enviado un nuevo enlace de verificación!');
    })->middleware('throttle:6,1')->name('verification.send');

    // ── RF04/RF05/RF06 – Administración de Restaurantes y Platillos ──────────
    Route::prefix('admin')->name('admin.')->middleware('role:admin,restaurante,operador_restaurante')->group(function () {

        // CRUD Restaurantes
        Route::resource('restaurantes', RestauranteController::class);

        // CRUD Platillos
        Route::resource('platillos', PlatilloController::class);

        // RF06 – Toggle disponibilidad (PATCH /admin/platillos/{platillo}/disponibilidad)
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
            Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.store');
        });
    });

    // Carrito de Pedidos (Tarea 14)
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
});
