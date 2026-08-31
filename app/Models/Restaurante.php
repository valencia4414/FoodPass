<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    use HasFactory;

    protected $table = 'restaurantes';

    protected $fillable = [
        'nombre',
        'logo',
        'direccion',
        'ciudad',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Un restaurante tiene muchos platillos.
     */
    public function platillos()
    {
        return $this->hasMany(Platillo::class);
    }
}
