<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $table = "libros";

    protected $guarded = [];

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'libro_autores', 'libro_id', 'autor_id')
            ->withPivot('es_principal');
    }

    public function especialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'libro_especialidades', 'libro_id', 'especialidad_id');
    }

    public function ejemplares()
    {
        return $this->hasMany(Ejemplar::class, 'libro_id');
    }
}
