<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psy\Util\Str;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        if(!is_null($user) && Hash::check($request->password, $user->password))
        {
            $user->api_token = Str::random(150);
            $user->save();

            return response()->json([
                'res' => true,
                'token' => $user->api_token,
                'message' => 'Bienvenido al sistema'
            ], 200);
        }
        else{
            return response()->json([
                'res' => false,
                'message' => 'Cuenta o password incorrectos'
            ], 200);
        }
    }

    public function logout()
    {
        $user = auth()->user();
        $user->api_token = null;
        $user->save();

        auth()->logout();

        return response()->json([
            'res' => true,
            'message' => 'Adios',
        ], 200);
    }
}
