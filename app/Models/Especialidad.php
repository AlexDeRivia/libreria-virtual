<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = "especialidades";

    protected $guarded = [];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuario_especialidades', 'especialidad_id', 'usuario_id');
    }
}
