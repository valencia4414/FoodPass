<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    public function index(Request $request)
{
    $query = \App\Models\Canje::where('user_id', auth()->id());

    // Punto 23: Filtros funcionales
    if ($request->filter == 'ultimos_30') {
        $query->where('created_at', '>=', now()->subDays(30));
    } elseif ($request->filter == 'pendientes') {
        $query->where('estado', 'pendiente');
    }

    // Punto 24: Paginación real
    $pedidos = $query->latest()->paginate(8);

    return view('historial_foodpass.index', compact('pedidos'));
}

// Punto 25: Vista de detalle
public function show($id)
{
    $pedido = \App\Models\Canje::where('user_id', auth()->id())->findOrFail($id);
    return view('historial_foodpass.show', compact('pedido'));
}
}
