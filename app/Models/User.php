<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
        protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'es_beneficiario_sena',
<<<<<<< HEAD
        'telefono',
        'direccion',
        'idioma_preferido',
        'foto_perfil',
        'membresia',
        'fecha_renovacion_membresia',
        'puntos_fp',
=======
        'google2fa_secret',
        'google2fa_enabled',
>>>>>>> acab2ef7ff501e8ec4cc1a538a5222850f87a411
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
        protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret',
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
       protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'es_beneficiario_sena' => 'boolean',
            'google2fa_enabled' => 'boolean',
        ];
    }

    /**
     * Funciones de ayuda para verificar roles de seguridad
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isRestaurante(): bool
    {
        return $this->role === 'restaurante' || $this->role === 'operador_restaurante';
    }

    public function isBeneficiario(): bool
    {
        return $this->role === 'beneficiario' || (bool) $this->es_beneficiario_sena;
    }

    public function isCliente(): bool
    {
        return $this->role === 'cliente';
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\CustomResetPassword($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\CustomVerifyEmail());
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'usuario_id', 'id');
    }
}
