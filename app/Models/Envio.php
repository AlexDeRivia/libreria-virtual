<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    use HasFactory;

    protected $table = "envios";

    protected $guarded = [];

    public function estado()
    {
        return $this->belongsTo(EstadoEnvio::class, 'estado_envio_id');
    }
}
