<?php

namespace App\Services;

use App\Mail\AdminOtpMail;
use App\Models\OtpToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class OtpService
{
    /**
     * Genera un código OTP de 6 dígitos, lo guarda hasheado y lo envía por correo.
     * Invalida tokens anteriores no usados del mismo usuario.
     */
    public function generateAndSend(User $user): void
    {
        OtpToken::where('user_id', $user->id)
            ->where('usado', false)
            ->update(['usado' => true]);

        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        OtpToken::create([
            'user_id' => $user->id,
            'token' => Hash::make($code),
            'expira_en' => now()->addMinutes(10),
            'usado' => false,
        ]);

        Mail::to($user->email)->send(new AdminOtpMail($code, $user->name));
    }

    /**
     * Verifica el código OTP. Si es válido, lo marca como usado.
     */
    public function verify(User $user, string $code): bool
    {
        $otp = OtpToken::where('user_id', $user->id)
            ->where('usado', false)
            ->where('expira_en', '>', now())
            ->latest()
            ->first();

        if (!$otp || !Hash::check($code, $otp->token)) {
            return false;
        }

        $otp->update(['usado' => true]);

        return true;
    }
}