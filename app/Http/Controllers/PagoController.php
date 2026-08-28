<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|integer',
            'monto' => 'required|numeric|min:0',
            'metodo' => 'required|in:nequi,efectivo,transferencia,tarjeta',
            'referencia_externa' => 'nullable|string'
        ]);

        // Registrar la transacción
        $transaccionId = DB::table('transacciones')->insertGetId([
            'user_id' => auth()->id(),
            'pedido_id' => $request->pedido_id,
            'monto' => $request->monto,
            'metodo' => $request->metodo,
            'estado' => 'aprobado', // Asumimos aprobado para generar comprobante
            'referencia_externa' => $request->referencia_externa,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Datos para el comprobante PDF (cumpliendo la tarea 93)
        $data = [
            'pedido_id' => $request->pedido_id,
            'monto' => $request->monto,
            'metodo' => $request->metodo,
            'fecha' => now()->format('Y-m-d H:i:s'),
            'transaccion_id' => $transaccionId
        ];

        // Generar el PDF usando una vista (crea una vista simple ej: pdf.comprobante)
        $pdf = Pdf::loadView('pdf.comprobante', $data);

        // Guardar el PDF en el storage
        $fileName = 'comprobante_' . $request->pedido_id . '.pdf';
        \Storage::disk('public')->put('comprobantes/' . $fileName, $pdf->output());

        return response()->json([
            'mensaje' => 'Pago registrado y comprobante en PDF generado con éxito',
            'archivo' => 'storage/comprobantes/' . $fileName
        ], 201);
    }
}