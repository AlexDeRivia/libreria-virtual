<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = "autores";

    protected $guarded = [];

    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'libro_autores', 'autor_id', 'libro_id');
    }

    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class, 'nacionalidad_id');
    }
}
