<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\MetodosPagoController;
use App\Http\Controllers\MenuDigitalController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CanjeController;
use App\Http\Controllers\HarvestLedgerController;
use App\Http\Controllers\PlatilloController;
use App\Http\Controllers\RestauranteController;

// Redirigir raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas públicas (solo para no autenticados)
Route::middleware('guest')->group(function () {
    Route::get('/login',     [LoginController::class,   'showLogin'])->name('login');
    Route::post('/login',    [LoginController::class,   'login'])->name('login.post');
    Route::get('/register',  [RegisterController::class,'showRegister'])->name('register');
    Route::post('/register', [RegisterController::class,'register'])->name('register.post');
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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
    
    // --- RF04: Canje y Beneficio SENA ---
    Route::get('/canje',          [CanjeController::class,        'index'])->name('canje');
    Route::post('/canje',         [CanjeController::class,        'store'])->name('canje.store'); // Para procesar el canje
    
    Route::get('/harvest-ledger', [HarvestLedgerController::class,'index'])->name('harvest-ledger');

    // ── RF04/RF05/RF06 – Administración de Restaurantes y Platillos ──────────
    Route::prefix('admin')->name('admin.')->group(function () {

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

});