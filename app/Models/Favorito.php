<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model {
    use HasFactory;

    protected $table = 'Favorito';
    protected $primaryKey = 'id_favorito';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_lugar',
        'fecha_agregado'
    ];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function lugar() {
        return $this->belongsTo(Lugar::class, 'id_lugar', 'id_lugar');
    }
}
