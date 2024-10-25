<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 
use Exception;

class AuthController extends Controller
{
    /**
     *   @OA\post
     *     (
     *     path="/api/auth/register",
     *     summary="Registro de usuario",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Datos necesarios para crear un usuario",
     *         @OA\JsonContent(
     *             required={"name", "email","password"},
     *             @OA\Property(property="name", type="string", example="Clever"),
     *             @OA\Property(property="email", type="string", format="float", example="Test@gmail.com"),
     *             @OA\Property(property="password", type="string", example="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Crea un usuario"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
     */
    public function register(Request $request)
    {
        try{
            $user= User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => hash::make($request->password),
            ]);
            $accessToken = $user->createToken('authToken')->accessToken;
        
            return response()->json([
                'user'=>$user,
                'access_token' => $accessToken
            ]);
        }
        catch(Exception $e)
        {
            return response() -> json(
                [
                    'success'=> false,
                    'message'=> 'Ocurrio un error, comuniquese con su Administrador',
                    'error' => $e->getMessage()
                ],500
            );
        }   
    }
    /**
     *   @OA\post
     *     (
     *     path="/api/auth/login",
     *     summary="Login de usuario",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Datos necesarios para loggear un usuario",
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="float", example="Test@gmail.com"),
     *             @OA\Property(property="password", type="string", example="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Crea un usuario"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
    */
    public function login(Request $request)
    {
        try{
            if(!auth()->attempt(['email' => $request->email, 'password' => $request->password]))
            {
                return response()->json([
                    'message' => 'Credenciales no validas'
                ],401);
            }
            $user = auth()->user();
            $accessToken = $user->createToken($user->email)->accessToken;
            
            return response()->json([
                'user'=>$user,
                'access_token' => $accessToken
            ]);
        }
        catch(Exception $e)
        {
            return response() -> json(
                [
                    'success'=> false,
                    'message'=> 'Ocurrio un error, comuniquese con su Administrador',
                    'error' => $e->getMessage(),
                    'track' => $e->getTrace()
                ],500
            );
        }   
    }
}
