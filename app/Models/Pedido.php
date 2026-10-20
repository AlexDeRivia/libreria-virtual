<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = "pedidos";

    protected $guarded = [];

    public function lineaPedidos()
    {
        return $this->hasMany(LineaPedido::class);
    }

    public function envio()
    {
        return $this->belongsTo(Envio::class, 'envio_id');
    }
}
