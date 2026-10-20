<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $table = "provincias";

    protected $guarded = [];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }
}
