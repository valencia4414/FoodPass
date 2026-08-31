<?php

namespace App\Http\Controllers;

use App\Models\Platillo;
use App\Models\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlatilloController extends Controller
{
    /**
     * RF04 – Listar todos los platillos con su restaurante.
     * GET /admin/platillos
     */
    public function index(Request $request)
    {
        $query = Platillo::with('restaurante');

        // Filtros opcionales
        if ($request->filled('restaurante_id')) {
            $query->where('restaurante_id', $request->restaurante_id);
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        if ($request->filled('disponible')) {
            $query->where('disponible', (bool) $request->disponible);
        }

        $platillos     = $query->orderBy('created_at', 'desc')->paginate(20);
        $restaurantes  = Restaurante::orderBy('nombre')->get();

        return view('admin.platillos.index', compact('platillos', 'restaurantes'));
    }

    /**
     * RF04 – Mostrar formulario de creación.
     * GET /admin/platillos/create
     */
    public function create()
    {
        $restaurantes = Restaurante::where('activo', true)->orderBy('nombre')->get();
        return view('admin.platillos.create', compact('restaurantes'));
    }

    /**
     * RF04/RF05 – Guardar nuevo platillo con imagen.
     * POST /admin/platillos
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurante_id' => 'required|exists:restaurantes,id',
            'nombre'         => 'required|string|max:255',
            'descripcion'    => 'required|string',
            'precio'         => 'required|numeric|min:0',
            'categoria'      => 'required|in:entrada,plato_fuerte,postre,bebida',
            'ingredientes'   => 'nullable|string',
            'imagen'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'disponible'     => 'boolean',
            'stock'          => 'nullable|integer|min:0',
        ]);

        // RF05 – Subida de imagen
        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')
                ->store('platillos', 'public');
        }

        $validated['disponible'] = $request->boolean('disponible', true);

        $platillo = Platillo::create($validated);

        return redirect()
            ->route('admin.platillos.index')
            ->with('success', "Platillo \"{$platillo->nombre}\" creado correctamente.");
    }

    /**
     * RF04 – Mostrar detalle de un platillo.
     * GET /admin/platillos/{platillo}
     */
    public function show(Platillo $platillo)
    {
        $platillo->load('restaurante');
        return view('admin.platillos.show', compact('platillo'));
    }

    /**
     * RF04 – Mostrar formulario de edición.
     * GET /admin/platillos/{platillo}/edit
     */
    public function edit(Platillo $platillo)
    {
        $restaurantes = Restaurante::where('activo', true)->orderBy('nombre')->get();
        return view('admin.platillos.edit', compact('platillo', 'restaurantes'));
    }

    /**
     * RF04/RF05 – Actualizar platillo con imagen.
     * PUT/PATCH /admin/platillos/{platillo}
     */
    public function update(Request $request, Platillo $platillo)
    {
        $validated = $request->validate([
            'restaurante_id' => 'required|exists:restaurantes,id',
            'nombre'         => 'required|string|max:255',
            'descripcion'    => 'required|string',
            'precio'         => 'required|numeric|min:0',
            'categoria'      => 'required|in:entrada,plato_fuerte,postre,bebida',
            'ingredientes'   => 'nullable|string',
            'imagen'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'disponible'     => 'boolean',
            'stock'          => 'nullable|integer|min:0',
        ]);

        // RF05 – Reemplazar imagen si se subió una nueva
        if ($request->hasFile('imagen')) {
            // Borrar imagen anterior del disco
            if ($platillo->imagen) {
                Storage::disk('public')->delete($platillo->imagen);
            }
            $validated['imagen'] = $request->file('imagen')
                ->store('platillos', 'public');
        }

        $validated['disponible'] = $request->boolean('disponible', $platillo->disponible);

        $platillo->update($validated);

        return redirect()
            ->route('admin.platillos.index')
            ->with('success', "Platillo \"{$platillo->nombre}\" actualizado correctamente.");
    }

    /**
     * RF04 – Eliminar platillo y su imagen.
     * DELETE /admin/platillos/{platillo}
     */
    public function destroy(Platillo $platillo)
    {
        // Borrar imagen del disco si existe
        if ($platillo->imagen) {
            Storage::disk('public')->delete($platillo->imagen);
        }

        $nombre = $platillo->nombre;
        $platillo->delete();

        return redirect()
            ->route('admin.platillos.index')
            ->with('success', "Platillo \"{$nombre}\" eliminado correctamente.");
    }

    /**
     * RF06 – Cambiar disponibilidad de un platillo (toggle).
     * PATCH /admin/platillos/{platillo}/disponibilidad
     */
    public function toggleDisponibilidad(Platillo $platillo)
    {
        $platillo->disponible = ! $platillo->disponible;
        $platillo->save();

        $estado = $platillo->disponible ? 'disponible' : 'no disponible';

        if (request()->expectsJson()) {
            return response()->json([
                'success'    => true,
                'disponible' => $platillo->disponible,
                'mensaje'    => "Platillo marcado como {$estado}.",
            ]);
        }

        return back()->with('success', "Platillo marcado como {$estado}.");
    }
}
