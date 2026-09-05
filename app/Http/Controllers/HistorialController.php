<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistorialController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        // 1. Consulta de Canjes (SENA)
        $canjes = DB::table('canjes')
            ->select('id', 'created_at', 'estado', 'detalle', DB::raw("0 as total"), DB::raw("'canje' as tipo"))
            ->where('user_id', $userId);

        // 2. Consulta de Pedidos (Compras menú)
        $pedidosQuery = DB::table('pedidos')
            ->select('id', 'created_at', 'estado', DB::raw("'Compra menú digital' as detalle"), 'total', DB::raw("'pedido' as tipo"))
            ->where('user_id', $userId);

        // 3. Unimos ambas consultas
        $unionQuery = $canjes->union($pedidosQuery);

        // Preparamos la subconsulta para poder filtrar y paginar la unión
        $query = DB::table(DB::raw("({$unionQuery->toSql()}) as historial"))
            ->mergeBindings($unionQuery);

        if ($request->filter == 'ultimos_30') {
            $query->where('created_at', '>=', now()->subDays(30));
        } elseif ($request->filter == 'pendientes') {
            $query->where('estado', 'pendiente');
        }

        // Paginamos los resultados combinados ordenados por fecha descendente
        $pedidos = $query->orderBy('created_at', 'desc')->paginate(8);

        return view('historial_foodpass.index', compact('pedidos'));
    }

    public function show(Request $request, $id)
    {
        $tipo = $request->query('tipo', 'canje');

        if ($tipo == 'pedido') {
            $pedido = \App\Models\Pedido::where('user_id', auth()->id())->findOrFail($id);
            $pedido->tipo = 'pedido';
            $pedido->detalle = 'Compra menú digital';
        } else {
            $pedido = \App\Models\Canje::where('user_id', auth()->id())->findOrFail($id);
            $pedido->tipo = 'canje';
            $pedido->total = 0;
            $pedido->detalle = $pedido->detalle ?? 'Almuerzo Artesanal Completo';
        }

        return view('historial_foodpass.show', compact('pedido'));
    }
}
