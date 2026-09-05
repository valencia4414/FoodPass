<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function show(Request $request)
    {
        if (!$request->session()->has('otp_user_id')) {
            return redirect()->route('login');
        }

        $user = User::find($request->session()->get('otp_user_id'));

        if (!$user) {
            $request->session()->forget(['otp_user_id', 'otp_remember']);
            return redirect()->route('login');
        }

        return view('login_foodpass.otp-verify', [
            'email' => $user->email,
        ]);
    }

    public function verify(Request $request, OtpService $otpService)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ], [
            'code.required' => 'Ingresa el código de 6 dígitos.',
            'code.digits' => 'El código debe tener exactamente 6 dígitos.',
        ]);

        $userId = $request->session()->get('otp_user_id');

        if (!$userId) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Sesión de verificación expirada. Inicia sesión de nuevo.']);
        }

        $user = User::findOrFail($userId);

        if (!$otpService->verify($user, $request->code)) {
            return back()->withErrors(['code' => 'Código inválido o expirado.']);
        }

        $remember = (bool) $request->session()->get('otp_remember', false);
        $request->session()->forget(['otp_user_id', 'otp_remember']);

        Auth::login($user, $remember);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function resend(Request $request, OtpService $otpService)
    {
        $userId = $request->session()->get('otp_user_id');

        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::findOrFail($userId);
        $otpService->generateAndSend($user);

        return back()->with('status', 'Se envió un nuevo código a tu correo.');
    }
}