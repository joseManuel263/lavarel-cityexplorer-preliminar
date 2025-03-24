<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'Usuario'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'id_usuario'; // Clave primaria personalizada

    public $timestamps = false; // Desactivar timestamps si la tabla no tiene created_at y updated_at

    protected $fillable = [
        'nombre',
        'apellidoP',
        'apellidoM',
        'correo',
        'contraseña',
        'id_rol',
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'contraseña' => 'hashed',
        ];
    }

    // Relaciones
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function lugares()
    {
        return $this->hasMany(Lugar::class, 'id_usuario');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_usuario');
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'id_usuario');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_usuario');
    }

    public function listas()
    {
        return $this->hasMany(Lista::class, 'id_usuario');
    }
}
