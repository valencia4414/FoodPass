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

        // 2. Consulta de Pedidos (Compras menú) adaptada a "usuario_id"
        $pedidosQuery = DB::table('pedidos')
            ->select('id', 'created_at', 'estado', DB::raw("'Compra menú digital' as detalle"), 'total', DB::raw("'pedido' as tipo"))
            ->where('usuario_id', $userId);

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
            $pedido = \App\Models\Pedido::where('usuario_id', auth()->id())->findOrFail($id);
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

    // ── Tarea 100: Historial de pedidos con filtros y paginación ──
    // GET /historial/pedidos?estado=pendiente&periodo=30dias
    public function pedidos(Request $request)
    {
        $query = \App\Models\Pedido::where('usuario_id', auth()->id());

        // Filtro por estado
        if ($request->has('estado') && $request->estado) {
            $query->where('estado', $request->estado);
        }

        // Filtro por periodo
        if ($request->has('periodo')) {
            switch ($request->periodo) {
                case '7dias':
                    $query->where('created_at', '>=', now()->subDays(7));
                    break;
                case '30dias':
                    $query->where('created_at', '>=', now()->subDays(30));
                    break;
                case '90dias':
                    $query->where('created_at', '>=', now()->subDays(90));
                    break;
            }
        }

        $pedidos = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($pedidos);
    }

    // ── Tarea 101: Historial de canjes ──
    // GET /historial/canjes
    public function canjes(Request $request)
    {
        $canjes = \App\Models\Canje::with('restaurante:id,nombre')
            ->where('user_id', auth()->id())
            ->select('id', 'user_id', 'restaurante_id', 'fecha_canje', 'monto', 'estado', 'detalle', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json($canjes);
    }

    // ── Tarea 102: Historial de transacciones/pagos ──
    // GET /historial/pagos
    public function pagos(Request $request)
    {
        $pagos = DB::table('pagos')
            ->join('pedidos', 'pagos.pedido_id', '=', 'pedidos.id')
            ->where('pedidos.usuario_id', auth()->id())
            ->select('pagos.id', 'pagos.pedido_id', 'pagos.monto', 'pagos.metodo_pago as metodo', 'pagos.estado', 'pagos.referencia_pago as referencia_externa', 'pagos.fecha_pago as created_at')
            ->orderBy('pagos.fecha_pago', 'desc')
            ->paginate(10);

        return response()->json($pagos);
    }
}
