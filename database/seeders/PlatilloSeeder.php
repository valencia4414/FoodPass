<?php

namespace Database\Seeders;

use App\Models\Platillo;
use App\Models\Restaurante;
use Illuminate\Database\Seeder;

class PlatilloSeeder extends Seeder
{
    /**
     * Platillos de la Cafetería SENA.
     */
    public function run(): void
    {
        $cafeteria = Restaurante::where('nombre', 'Cafetería SENA')->first();

        if (! $cafeteria) {
            $this->command->error('❌ Ejecuta primero RestauranteSeeder.');
            return;
        }

        $platillos = [
            // ── PLATOS FUERTES ───────────────────────────────────────────────
            [
                'nombre'       => 'Arroz con Pollo',
                'descripcion'  => 'Arroz cocido con trozos de pollo tierno, condimentado con especias naturales y vegetales.',
                'precio'       => 8500.00,
                'categoria'    => 'plato_fuerte',
                'ingredientes' => 'Arroz, pollo, zanahoria, arveja, ajo, cebolla, comino, color, sal',
                'disponible'   => true,
                'stock'        => null,
            ],
            [
                'nombre'       => 'Carne de Cerdo',
                'descripcion'  => 'Carne de cerdo guisada en salsa criolla con tomate, cebolla y especias.',
                'precio'       => 9000.00,
                'categoria'    => 'plato_fuerte',
                'ingredientes' => 'Cerdo, tomate, cebolla, ajo, comino, color, cilantro, sal',
                'disponible'   => true,
                'stock'        => null,
            ],
            [
                'nombre'       => 'Pollo Guisado',
                'descripcion'  => 'Presa de pollo cocida en salsa de tomate y especias, acompañada de arroz y ensalada.',
                'precio'       => 8000.00,
                'categoria'    => 'plato_fuerte',
                'ingredientes' => 'Pollo, tomate, cebolla, ajo, pimentón, comino, laurel, sal',
                'disponible'   => true,
                'stock'        => null,
            ],
            [
                'nombre'       => 'Carne de Res',
                'descripcion'  => 'Bistec de res en salsa criolla con hogao, servido con guarnición.',
                'precio'       => 9500.00,
                'categoria'    => 'plato_fuerte',
                'ingredientes' => 'Res, tomate, cebolla larga, ajo, comino, sal, pimienta',
                'disponible'   => true,
                'stock'        => null,
            ],

            // ── ENTRADAS / ACOMPAÑAMIENTOS ───────────────────────────────────
            [
                'nombre'       => 'Puré de Papa',
                'descripcion'  => 'Puré cremoso de papa criolla con un toque de mantequilla y sal.',
                'precio'       => 3000.00,
                'categoria'    => 'entrada',
                'ingredientes' => 'Papa criolla, mantequilla, leche, sal, pimienta',
                'disponible'   => true,
                'stock'        => null,
            ],
            [
                'nombre'       => 'Ensalada Fresca',
                'descripcion'  => 'Ensalada del día con verduras frescas de temporada y aderezo de limón.',
                'precio'       => 3500.00,
                'categoria'    => 'entrada',
                'ingredientes' => 'Lechuga, tomate, pepino, zanahoria, limón, sal, aceite de oliva',
                'disponible'   => true,
                'stock'        => null,
            ],
            [
                'nombre'       => 'Verduras Variadas',
                'descripcion'  => 'Mezcla de verduras cocidas al vapor: brócoli, zanahoria, habichuela y calabacín.',
                'precio'       => 3000.00,
                'categoria'    => 'entrada',
                'ingredientes' => 'Brócoli, zanahoria, habichuela, calabacín, sal, aceite',
                'disponible'   => true,
                'stock'        => null,
            ],
            [
                'nombre'       => 'Frijoles',
                'descripcion'  => 'Frijoles rojos o negros cocidos con hogao, ideales como acompañamiento.',
                'precio'       => 2500.00,
                'categoria'    => 'entrada',
                'ingredientes' => 'Frijoles, tomate, cebolla larga, ajo, comino, color, cilantro',
                'disponible'   => true,
                'stock'        => null,
            ],
            [
                'nombre'       => 'Lentejas',
                'descripcion'  => 'Sopa espesa de lentejas con plátano maduro, zanahoria y especias.',
                'precio'       => 2500.00,
                'categoria'    => 'entrada',
                'ingredientes' => 'Lentejas, plátano maduro, zanahoria, cebolla, ajo, comino, sal',
                'disponible'   => true,
                'stock'        => null,
            ],
            [
                'nombre'       => 'Arvejas',
                'descripcion'  => 'Arvejas tiernas guisadas con hogao y un toque de color.',
                'precio'       => 2500.00,
                'categoria'    => 'entrada',
                'ingredientes' => 'Arvejas, tomate, cebolla, ajo, comino, color, sal',
                'disponible'   => true,
                'stock'        => null,
            ],
        ];

        foreach ($platillos as $data) {
            $data['restaurante_id'] = $cafeteria->id;
            $data['imagen'] = null;

            Platillo::firstOrCreate(
                [
                    'restaurante_id' => $cafeteria->id,
                    'nombre'         => $data['nombre'],
                ],
                $data
            );
        }

        $this->command->info('✅ PlatilloSeeder: ' . count($platillos) . ' platillos de la Cafetería SENA insertados.');
    }
}
