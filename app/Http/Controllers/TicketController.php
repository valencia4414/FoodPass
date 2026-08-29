<?php

namespace App\Http\Controllers;

use App\Models\TicketSoporte;
use App\Models\RespuestaTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // Listar los tickets del usuario autenticado (o todos si es admin)
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $tickets = TicketSoporte::with('user')->orderBy('created_at', 'desc')->get();
        } else {
            $tickets = TicketSoporte::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        }

        return view('soporte.index', compact('tickets'));
    }

    // Crear un nuevo ticket
    public function store(Request $request)
    {
        $request->validate([
            'asunto' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        TicketSoporte::create([
            'user_id' => Auth::id(),
            'asunto' => $request->asunto,
            'descripcion' => $request->descripcion,
            'estado' => 'abierto',
        ]);

        return redirect()->back()->with('success', '¡Tu ticket de soporte ha sido creado exitosamente!');
    }

    // Ver detalle del ticket y sus respuestas
    public function show($id)
    {
        $ticket = TicketSoporte::with('respuestas.autor', 'user')->findOrFail($id);

        return view('soporte.show', compact('ticket'));
    }

    // Responder a un ticket
    public function responder(Request $request, $id)
    {
        $request->validate([
            'mensaje' => 'required|string',
        ]);

        RespuestaTicket::create([
            'ticket_id' => $id,
            'autor_id' => Auth::id(),
            'mensaje' => $request->mensaje,
        ]);

        return redirect()->back()->with('success', 'Respuesta enviada.');
    }

    // Cambiar estado del ticket (Solo Admin)
    public function cambiarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:abierto,en_proceso,cerrado',
        ]);

        $ticket = TicketSoporte::findOrFail($id);
        $ticket->update(['estado' => $request->estado]);

        return redirect()->back()->with('success', 'Estado del ticket actualizado.');
    }
}
