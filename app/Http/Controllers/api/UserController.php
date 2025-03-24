<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rows = (int)$request->input('rows', 10);
        $page = 1 + (int)$request->input('page', 0);

        \Illuminate\Pagination\Paginator::currentPageResolver(function() use ($page) {
            return $page;
        });

        $users = User::paginate($rows);
        return response()->json([
            'estatus' => 1,
            'data' => $users->items(),
            'total' => $users->total()
        ]);
    }

    /**
     * Create a new user.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estatus' => 0,
                'mensaje' => $validator->errors()
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'estatus' => 1,
            'mensaje' => 'Usuario registrado con éxito'
        ]);
    }

    /**
     * Show the specified user.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'estatus' => 0,
                'mensaje' => 'Usuario no encontrado'
            ]);
        }

        return response()->json([
            'estatus' => 1,
            'data' => $user
        ]);
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        if (!isset($request->name)) {
            return response()->json([
                'estatus' => 0,
                'mensaje' => 'El nombre es requerido'
            ]);
        }

        User::where('id', $id)->update([
            'name' => $request->name
        ]);

        return response()->json([
            'estatus' => 1,
            'mensaje' => 'Usuario actualizado con éxito'
        ]);
    }

    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'estatus' => 0,
                'mensaje' => 'Usuario no encontrado'
            ]);
        }

        $user->delete();
        return response()->json([
            'estatus' => 1,
            'mensaje' => 'Usuario eliminado con éxito'
        ]);
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'estatus' => 1,
                'mensaje' => 'Login exitoso',
                'access_token' => $token,
                'data' => $user
            ]);
        } else {
            return response()->json([
                'estatus' => 0,
                'mensaje' => 'Credenciales incorrectas'
            ]);
        }
    }
}
