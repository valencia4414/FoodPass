<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestauranteController extends Controller
{
    /**
     * Listar restaurantes.
     * GET /admin/restaurantes
     */
    public function index()
    {
        $restaurantes = Restaurante::withCount('platillos')
            ->orderBy('nombre')
            ->paginate(20);

        return view('admin.restaurantes.index', compact('restaurantes'));
    }

    /**
     * Mostrar formulario de creación.
     * GET /admin/restaurantes/create
     */
    public function create()
    {
        return view('admin.restaurantes.create');
    }

    /**
     * Guardar nuevo restaurante.
     * POST /admin/restaurantes
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'    => 'required|string|max:255',
            'logo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'direccion' => 'required|string|max:255',
            'ciudad'    => 'required|string|max:100',
            'activo'    => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')
                ->store('restaurantes/logos', 'public');
        }

        $validated['activo'] = $request->boolean('activo', true);

        $restaurante = Restaurante::create($validated);

        return redirect()
            ->route('admin.restaurantes.index')
            ->with('success', "Restaurante \"{$restaurante->nombre}\" creado correctamente.");
    }

    /**
     * Mostrar detalle de un restaurante.
     * GET /admin/restaurantes/{restaurante}
     */
    public function show(Restaurante $restaurante)
    {
        $restaurante->load('platillos');
        return view('admin.restaurantes.show', compact('restaurante'));
    }

    /**
     * Mostrar formulario de edición.
     * GET /admin/restaurantes/{restaurante}/edit
     */
    public function edit(Restaurante $restaurante)
    {
        return view('admin.restaurantes.edit', compact('restaurante'));
    }

    /**
     * Actualizar restaurante.
     * PUT/PATCH /admin/restaurantes/{restaurante}
     */
    public function update(Request $request, Restaurante $restaurante)
    {
        $validated = $request->validate([
            'nombre'    => 'required|string|max:255',
            'logo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'direccion' => 'required|string|max:255',
            'ciudad'    => 'required|string|max:100',
            'activo'    => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($restaurante->logo) {
                Storage::disk('public')->delete($restaurante->logo);
            }
            $validated['logo'] = $request->file('logo')
                ->store('restaurantes/logos', 'public');
        }

        $validated['activo'] = $request->boolean('activo', $restaurante->activo);

        $restaurante->update($validated);

        return redirect()
            ->route('admin.restaurantes.index')
            ->with('success', "Restaurante \"{$restaurante->nombre}\" actualizado correctamente.");
    }

    /**
     * Eliminar restaurante.
     * DELETE /admin/restaurantes/{restaurante}
     */
    public function destroy(Restaurante $restaurante)
    {
        if ($restaurante->logo) {
            Storage::disk('public')->delete($restaurante->logo);
        }

        $nombre = $restaurante->nombre;
        $restaurante->delete(); // cascade elimina platillos por FK

        return redirect()
            ->route('admin.restaurantes.index')
            ->with('success', "Restaurante \"{$nombre}\" eliminado correctamente.");
    }
}
