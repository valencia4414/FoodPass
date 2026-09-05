<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CuentaController extends Controller
{
    public function destroy(Request $request)
    {
        $user = $request->user();

        DB::transaction(function () use ($user): void {
            $user->delete();
        });

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return response()->json([
                'mensaje' => 'Tu cuenta y tus datos personales fueron eliminados correctamente.',
            ]);
        }

        return redirect()->route('login')->with('success', 'Tu cuenta y tus datos personales fueron eliminados correctamente.');
    }
}