<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login_foodpass.login');
    }

    public function login(Request $request, OtpService $otpService)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Ingresa un correo válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'Mínimo 6 caracteres.',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        // Validar credenciales sin iniciar sesión todavía
        if (!Auth::validate($credentials)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Credenciales incorrectas.']);
        }

        $user = \App\Models\User::where('email', $credentials['email'])->first();

        // RF21 — MFA obligatorio para administradores
        if ($user && $user->isAdmin()) {
            $otpService->generateAndSend($user);

            $request->session()->put('otp_user_id', $user->id);
            $request->session()->put('otp_remember', $remember);

            return redirect()->route('otp.verify')
                ->with('status', 'Enviamos un código de verificación a tu correo.');
        }

        // Usuarios no-admin: login normal
        Auth::login($user, $remember);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}