<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platillo extends Model
{
    use HasFactory;

    protected $table = 'platillos';

    protected $fillable = [
        'restaurante_id',
        'nombre',
        'descripcion',
        'precio',
        'categoria',
        'ingredientes',
        'imagen',
        'disponible',
        'stock',
    ];

    protected $casts = [
        'precio'     => 'decimal:2',
        'disponible' => 'boolean',
        'stock'      => 'integer',
    ];

    /**
     * Un platillo pertenece a un restaurante.
     */
    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }

    /**
     * Decrementa el stock en la cantidad indicada.
     * Si llega a 0, marca el platillo como no disponible.
     *
     * @param  int  $cantidad
     * @return void
     */
    public function decrementarStock(int $cantidad = 1): void
    {
        if (is_null($this->stock)) {
            // Sin control de stock, no hace nada
            return;
        }

        $nuevoStock = max(0, $this->stock - $cantidad);
        $this->stock = $nuevoStock;

        if ($nuevoStock <= 0) {
            $this->disponible = false;
        }

        $this->save();
    }
}
