<?php

namespace App\Http\Controllers;

use App\Models\BeneficiarioSena;
use App\Models\Canje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanjeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $hoy = now()->format('Y-m-d');

        // Verificar si ya canjeó hoy
        $yaCanjeoHoy = Canje::where('user_id', $user->id)
                        ->where('fecha_canje', $hoy)
                        ->exists();

        return view('canje_foodpass.index', compact('user', 'yaCanjeoHoy'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // ── Tarea 97: Validar elegibilidad del usuario para canje ──
        // Verificar que el email del usuario exista en beneficiarios_sena con activo = true
        $esBeneficiario = BeneficiarioSena::where('email', $user->email)
            ->where('activo', true)
            ->exists();

        if (!$esBeneficiario) {
            return back()->with('error', 'No eres beneficiario del programa alimentario.');
        }

        // ── Tarea 98: Control de canje único diario ──
        $yaCanjeoHoy = Canje::where('user_id', $user->id)
                        ->where('fecha_canje', today())
                        ->exists();

        if ($yaCanjeoHoy) {
            return back()->with('error', 'Ya utilizaste tu beneficio hoy.');
        }

        // ── Tarea 99: Registrar cada canje para auditoría ──
        Canje::create([
            'user_id'        => $user->id,
            'restaurante_id' => $request->restaurante_id,
            'monto'          => $request->monto ?? 0,
            'fecha_canje'    => today(),
            'periodo'        => now()->format('Y-m-d'),
            'estado'         => 'exitoso',
            'detalle'        => 'Almuerzo SENA',
        ]);

        return back()->with('success', '¡Beneficio canjeado exitosamente!');
    }
}
