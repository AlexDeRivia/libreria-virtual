<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoEnvio extends Model
{
    use HasFactory;

    protected $table = "estado_envios";

    protected $guarded = [];
}
