<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleErrorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request,Closure $next)
    {
       
        try{

            //var_dump("Ejecutando el middeware");
            return $next($request);
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
}
