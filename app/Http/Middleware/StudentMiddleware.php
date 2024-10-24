<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Validators\StudentValidator;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request,Closure $next)
    {
        try{
            if($request->isMethod('post')|$request->isMethod('put')|$request->isMethod('delete'))
            {
                $result =StudentValidator::Valid($request);
                if($result['isValid'])
                {
                    return $next($request);
                }
                else
                {
                    return $result;
                }
            }
            else
            {
                return $next($request);
            }
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
