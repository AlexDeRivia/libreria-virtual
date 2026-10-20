<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferenciaEnvio extends Model
{
    use HasFactory;

    protected $table = "preferencia_envios";

    protected $guarded = [];
}
