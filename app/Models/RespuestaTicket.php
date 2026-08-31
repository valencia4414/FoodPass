<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaTicket extends Model
{
    use HasFactory;

    protected $table = 'respuestas_ticket';

    protected $fillable = [
        'ticket_id',
        'autor_id',
        'mensaje',
    ];

    public function ticket()
    {
        return $this->belongsTo(TicketSoporte::class, 'ticket_id');
    }

    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }
}
