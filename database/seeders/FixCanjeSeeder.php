<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FixCanjeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear restaurante
        \App\Models\Restaurante::firstOrCreate(
            ['nombre' => 'Cafetería Principal SENA'],
            ['direccion' => 'Sede Principal', 'ciudad' => 'Bogotá', 'activo' => true]
        );

        // 2. Migrar de la tabla antigua 'usuarios' a las tablas de Laravel
        $usuariosAntiguos = \Illuminate\Support\Facades\DB::table('usuarios')->get();
        
        foreach($usuariosAntiguos as $u) {
            $user = \App\Models\User::firstOrCreate(
                ['email' => $u->email],
                [
                    'name' => $u->nombre_completo,
                    'password' => $u->password_hash,
                    'role' => 'beneficiario',
                    'es_beneficiario_sena' => $u->es_beneficiario_sena
                ]
            );

            if ($u->es_beneficiario_sena) {
                \App\Models\BeneficiarioSena::firstOrCreate(
                    ['email' => $user->email],
                    [
                        'numero_documento' => $u->documento_identidad,
                        'nombre_completo' => $user->name,
                        'activo' => true
                    ]
                );
            }
        }
    }
}
