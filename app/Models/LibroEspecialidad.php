<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroEspecialidad extends Model
{
    use HasFactory;

    protected $table = "libro_especialidades";

    protected $guarded = [];
}
