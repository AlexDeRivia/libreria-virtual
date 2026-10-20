<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejemplar extends Model
{
    use HasFactory;

    protected $table = "ejemplares";

    protected $guarded = [];

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }

    public function idioma()
    {
        return $this->belongsTo(Idioma::class, 'idioma_id');
    }

    public function lineaPedidos()
    {
        return $this->hasMany(LineaPedido::class, 'ejemplar_id');
    }
}
