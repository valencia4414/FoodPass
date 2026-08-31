<?php

namespace App\Http\Controllers;

use App\Models\Platillo;
use App\Models\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuDigitalController extends Controller
{
    public function index(Request $request)
    {
        $usuario = Auth::user();

        // Restaurante activo (Cafetería SENA)
        $restaurante = Restaurante::where('activo', true)->first();

        // Filtro de categoría desde el tab activo
        $categoriaActiva = $request->get('categoria', 'todos');

        // Tarea 9: Quitamos "where disponible = true" para poder mostrar platillos AGOTADOS
        $query = Platillo::query();

        if ($restaurante) {
            $query->where('restaurante_id', $restaurante->id);
        }

        if ($categoriaActiva !== 'todos') {
            $query->where('categoria', $categoriaActiva);
        }

        $platillos = $query->orderBy('categoria')->orderBy('nombre')->get();

        // Platillo hero: primer plato fuerte disponible
        $platilloHero = Platillo::where('categoria', 'plato_fuerte')
            ->when($restaurante, fn($q) => $q->where('restaurante_id', $restaurante->id))
            ->first();

        return view('men_digital_foodpass.menu_digital', compact(
            'usuario',
            'restaurante',
            'platillos',
            'platilloHero',
            'categoriaActiva'
        ));
    }
}
