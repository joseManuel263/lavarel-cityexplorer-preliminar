<?php

use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\DireccionController;
use App\Http\Controllers\Api\CategoriaLugarController;
use App\Http\Controllers\Api\LugarController;
use App\Http\Controllers\Api\ComentarioController;
use App\Http\Controllers\Api\FavoritoController;
use App\Http\Controllers\Api\PagoController;
use App\Http\Controllers\Api\ListaController;
use App\Http\Controllers\Api\ListaLugarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Ruta de prueba
Route::post('hola', function(){
    return response()->json(['message' => 'Hello World!']);
});

// Ruta para el login
Route::post('user/login', [UsuarioController::class, 'login']);

// Ruta para registrar un usuario
Route::post('usuario', [UsuarioController::class, 'create']);

// Grupo de rutas protegidas con autenticación Sanctum
Route::middleware(['auth:sanctum'])->group(function() {

    // Rutas para UsuarioController
    Route::prefix('usuario')->group(function() {
        Route::get('', [UsuarioController::class, 'index']); // Obtener todos los usuarios
        Route::post('', [UsuarioController::class, 'create']); // Crear un nuevo usuario
        Route::get('/{id}', [UsuarioController::class, 'show'])->whereNumber('id'); // Obtener usuario por ID
        Route::patch('/{id}', [UsuarioController::class, 'update'])->whereNumber('id'); // Actualizar usuario por ID
        Route::delete('/{id}', [UsuarioController::class, 'destroy'])->whereNumber('id'); // Eliminar usuario por ID
    });

    // Rutas para RolController
    Route::prefix('rol')->group(function() {
        Route::get('', [RolController::class, 'index']); // Obtener todos los roles
        Route::post('', [RolController::class, 'create']); // Crear un nuevo rol
        Route::get('/{id}', [RolController::class, 'show'])->whereNumber('id'); // Obtener rol por ID
        Route::patch('/{id}', [RolController::class, 'update'])->whereNumber('id'); // Actualizar rol por ID
        Route::delete('/{id}', [RolController::class, 'destroy'])->whereNumber('id'); // Eliminar rol por ID
    });

    // Rutas para DireccionController
    Route::prefix('direccion')->group(function() {
        Route::get('', [DireccionController::class, 'index']); // Obtener todas las direcciones
        Route::post('', [DireccionController::class, 'create']); // Crear una nueva dirección
        Route::get('/{id}', [DireccionController::class, 'show'])->whereNumber('id'); // Obtener dirección por ID
        Route::patch('/{id}', [DireccionController::class, 'update'])->whereNumber('id'); // Actualizar dirección por ID
        Route::delete('/{id}', [DireccionController::class, 'destroy'])->whereNumber('id'); // Eliminar dirección por ID
    });

    // Rutas para CategoriaLugarController
    Route::prefix('categoria_lugar')->group(function() {
        Route::get('', [CategoriaLugarController::class, 'index']); // Obtener todas las categorías de lugar
        Route::post('', [CategoriaLugarController::class, 'create']); // Crear una nueva categoría de lugar
        Route::get('/{id}', [CategoriaLugarController::class, 'show'])->whereNumber('id'); // Obtener categoría por ID
        Route::patch('/{id}', [CategoriaLugarController::class, 'update'])->whereNumber('id'); // Actualizar categoría por ID
        Route::delete('/{id}', [CategoriaLugarController::class, 'destroy'])->whereNumber('id'); // Eliminar categoría por ID
    });

    // Rutas para LugarController
    Route::prefix('lugar')->group(function() {
        Route::get('', [LugarController::class, 'index']); // Obtener todos los lugares
        Route::post('', [LugarController::class, 'store']); // Crear un nuevo lugar
        Route::get('/{id}', [LugarController::class, 'show'])->whereNumber('id'); // Obtener lugar por ID
        Route::patch('/{id}', [LugarController::class, 'update'])->whereNumber('id'); // Actualizar lugar por ID
        Route::delete('/{id}', [LugarController::class, 'destroy'])->whereNumber('id'); // Eliminar lugar por ID
    });

    // Rutas para ComentarioController
    Route::prefix('comentario')->group(function() {
        Route::get('', [ComentarioController::class, 'index']); // Obtener todos los comentarios
        Route::post('', [ComentarioController::class, 'store']); // Crear un nuevo comentario
        Route::get('/{id}', [ComentarioController::class, 'show'])->whereNumber('id'); // Obtener comentario por ID
        Route::patch('/{id}', [ComentarioController::class, 'update'])->whereNumber('id'); // Actualizar comentario por ID
        Route::delete('/{id}', [ComentarioController::class, 'destroy'])->whereNumber('id'); // Eliminar comentario por ID
    });

    // Rutas para FavoritoController
    Route::prefix('favorito')->group(function() {
        Route::get('', [FavoritoController::class, 'index']); // Obtener todos los favoritos
        Route::post('', [FavoritoController::class, 'store']); // Guardar un favorito
        Route::get('/{id}', [FavoritoController::class, 'show'])->whereNumber('id'); // Obtener favorito por ID
        Route::delete('/{id}', [FavoritoController::class, 'destroy'])->whereNumber('id'); // Eliminar favorito por ID
    });

    // Rutas para PagoController
    Route::prefix('pago')->group(function() {
        Route::get('', [PagoController::class, 'index']); // Obtener todos los pagos
        Route::post('', [PagoController::class, 'store']); // Realizar un pago
        Route::get('/{id}', [PagoController::class, 'show'])->whereNumber('id'); // Obtener pago por ID
        Route::delete('/{id}', [PagoController::class, 'destroy'])->whereNumber('id'); // Eliminar pago por ID
    });

    // Rutas para ListaController
    Route::prefix('lista')->group(function() {
        Route::get('', [ListaController::class, 'index']); // Obtener todas las listas
        Route::post('', [ListaController::class, 'store']); // Crear una nueva lista
        Route::get('/{id}', [ListaController::class, 'show'])->whereNumber('id'); // Obtener lista por ID
        Route::patch('/{id}', [ListaController::class, 'update'])->whereNumber('id'); // Actualizar lista por ID
        Route::delete('/{id}', [ListaController::class, 'destroy'])->whereNumber('id'); // Eliminar lista por ID
    });

    // Rutas para ListaLugarController
    Route::prefix('lista_lugar')->group(function() {
        Route::get('', [ListaLugarController::class, 'index']); // Obtener todos los lugares en listas
        Route::post('', [ListaLugarController::class, 'store']); // Relacionar lugar con lista
        Route::get('/{id}', [ListaLugarController::class, 'show'])->whereNumber('id'); // Obtener relación lista-lugar por ID
        Route::delete('/{id}', [ListaLugarController::class, 'destroy'])->whereNumber('id'); // Eliminar relación lista-lugar por ID
    });

});

// Obtener la autenticación del usuario
Route::get('/user', function (Request $request) {
    return response()->json($request->user());
})->middleware('auth:sanctum');
