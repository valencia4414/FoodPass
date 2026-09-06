<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canje extends Model
{
    use HasFactory;

    // Campos que permitimos llenar
    protected $fillable = [
        'user_id',
        'restaurante_id',
        'monto',
        'fecha_canje',
        'periodo',
        'estado',
        'detalle',
    ];

    protected $casts = [
        'fecha_canje' => 'date',
        'monto'       => 'decimal:2',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el restaurante
    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }
}