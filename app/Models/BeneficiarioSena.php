<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiarioSena extends Model
{
    use HasFactory;

    protected $table = 'beneficiarios_sena';

    protected $fillable = [
        'numero_documento',
        'nombre_completo',
        'email',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];
}
