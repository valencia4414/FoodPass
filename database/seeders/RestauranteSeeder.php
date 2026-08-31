<?php

namespace Database\Seeders;

use App\Models\Restaurante;
use Illuminate\Database\Seeder;

class RestauranteSeeder extends Seeder
{
    /**
     * Seed del restaurante Cafetería SENA.
     */
    public function run(): void
    {
        $restaurantes = [
            [
                'nombre'    => 'Cafetería SENA',
                'logo'      => null,
                'direccion' => 'Centro de Formación SENA',
                'ciudad'    => 'Colombia',
                'activo'    => true,
            ],
        ];

        foreach ($restaurantes as $data) {
            Restaurante::firstOrCreate(
                ['nombre' => $data['nombre']],
                $data
            );
        }

        $this->command->info('✅ RestauranteSeeder: Cafetería SENA insertada.');
    }
}
