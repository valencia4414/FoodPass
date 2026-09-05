<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    // Punto 89: Obtener historial paginado con filtros
    public function index(Request $request)
    {
        $query = Pedido::where('user_id', auth()->id());

        if ($request->has('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->has('fecha')) {
            $query->whereDate('created_at', $request->fecha);
        }

        return response()->json($query->orderBy('created_at', 'desc')->paginate(10));
    }

    // Punto 86: Crear pedido validando disponibilidad y calculando total
    public function store(Request $request)
    {
        $request->validate([
            'restaurante_id' => 'required|exists:restaurantes,id',
            'metodo_pago' => 'required|in:efectivo,transferencia,nequi,tarjeta',
            'items' => 'required|array|min:1',
            'items.*.platillo_id' => 'required|exists:platillos,id',
            'items.*.cantidad' => 'required|integer|min:1',
        ]);

        return DB::transaction(function () use ($request) {
            $total = 0;
            $itemsAInsertar = [];

            foreach ($request->items as $item) {
                $platillo = Platillo::findOrFail($item['platillo_id']);

                if (!$platillo->disponible) {
                    return response()->json(['error' => "El platillo {$platillo->nombre} no está disponible."], 400);
                }

                $total += $platillo->precio * $item['cantidad'];

                $itemsAInsertar[] = [
                    'platillo_id' => $platillo->id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $platillo->precio,
                ];
            }

            $pedido = Pedido::create([
                'user_id' => auth()->id(),
                'restaurante_id' => $request->restaurante_id,
                'metodo_pago' => $request->metodo_pago,
                'total' => $total,
                'estado' => 'pendiente',
            ]);

            foreach ($itemsAInsertar as $detalle) {
                $pedido->detalles()->create($detalle);
            }

            request()->session()->flash('success', '¡Tu pedido fue realizado con éxito!');

            return response()->json($pedido->load('detalles'), 201);
        });
    }

    // Punto 88: Detalle completo de un pedido específico
    public function show($id)
    {
        $pedido = Pedido::with(['detalles.platillo', 'user'])->findOrFail($id);
        return response()->json($pedido);
    }

    // Punto 87: Cambiar estado aplicando reglas de roles
    public function update(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,en_preparacion,entregado,cancelado',
        ]);

        $pedido = Pedido::findOrFail($id);
        $user = auth()->user();

        // Usuario cancela su propia orden solo si está en 'pendiente'
        if ($user->id === $pedido->user_id && $request->estado === 'cancelado' && $pedido->estado === 'pendiente') {
            $pedido->update(['estado' => 'cancelado']);
            return response()->json($pedido);
        }

        // Admin u Operador avanzan estados
        if (in_array($user->role, ['admin', 'operador_restaurante'])) {
            if (in_array($request->estado, ['en_preparacion', 'entregado', 'cancelado'])) {
                $pedido->update(['estado' => $request->estado]);
                return response()->json($pedido);
            }
        }

        return response()->json(['error' => 'No tienes permisos para este cambio.'], 403);
    }
}
