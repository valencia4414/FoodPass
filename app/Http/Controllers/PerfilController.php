<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PerfilController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        return view('mi_perfil_foodpass.perfil', compact('usuario'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'idioma_preferido' => 'required|string|in:es,en',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Validar contraseña solo si el usuario ingresó una
        if ($request->filled('password')) {
            $rules['password'] = [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ];
        }

        $request->validate($rules, [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Ingresa un correo válido.',
            'email.unique' => 'Este correo ya está registrado por otro usuario.',
            'foto_perfil.image' => 'El archivo debe ser una imagen.',
            'foto_perfil.max' => 'La imagen no debe pesar más de 2MB.',
        ]);

        $data = $request->only('name', 'email', 'telefono', 'direccion', 'idioma_preferido');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto_perfil')) {
            // Eliminar imagen anterior si existe
            if ($user->foto_perfil && \Storage::disk('public')->exists($user->foto_perfil)) {
                \Storage::disk('public')->delete($user->foto_perfil);
            }
            $path = $request->file('foto_perfil')->store('avatars', 'public');
            $data['foto_perfil'] = $path;
        }

        $user->update($data);

        return back()->with('success', 'Perfil actualizado correctamente.');
    }
}
