<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canje extends Model
{
    use HasFactory;

    // Campos que permitimos llenar
    protected $fillable = ['user_id', 'estado', 'detalle'];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}