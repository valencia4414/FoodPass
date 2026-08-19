<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanjeController extends Controller
{
    public function index() {
    $user = auth()->user();
    $hoy = now()->format('Y-m-d');
    
    // Verificar si ya canjeó hoy
    $yaCanjeoHoy = \App\Models\Canje::where('user_id', $user->id)
                    ->whereDate('created_at', $hoy)
                    ->exists();

    return view('canje_foodpass.index', compact('user', 'yaCanjeoHoy'));
}
    public function store(Request $request)
{
    $user = auth()->user();

    // 1. Validar si es beneficiario
    if (!$user->es_beneficiario_sena) {
        return back()->with('error', 'No eres beneficiario del SENA.');
    }

    // 2. Validar si ya canjeó hoy (RF14)
    $yaCanjeoHoy = \App\Models\Canje::where('user_id', $user->id)
                    ->whereDate('created_at', today())
                    ->exists();

    if ($yaCanjeoHoy) {
        return back()->with('error', 'Ya utilizaste tu beneficio hoy.');
    }

    // 3. Crear el registro
    \App\Models\Canje::create([
        'user_id' => $user->id,
        'estado' => 'entregado',
        'detalle' => 'Almuerzo SENA'
    ]);

    return back()->with('success', '¡Canje realizado con éxito!');
}
}
