<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;

class CustomVerifyEmail extends Notification
{
    use Queueable;

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        return (new MailMessage)
            ->subject('¡Bienvenido a FoodPass! Confirma tu correo')
            ->greeting('¡Hola!')
            ->line('Gracias por registrarte en FoodPass, la plataforma de gestión alimentaria del SENA.')
            ->line('Por favor, confirma tu dirección de correo electrónico haciendo clic en el siguiente botón:')
            ->action('Confirmar mi cuenta', $verificationUrl)
            ->line('Si no creaste esta cuenta, no se requiere ninguna acción adicional.')
            ->salutation('¡Disfruta sin filas con FoodPass!');
    }
}
