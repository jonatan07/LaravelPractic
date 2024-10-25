<?php

namespace App\Http\Controllers;

/**
 *  @OA\Info(
 *      title="API Practica de laravel",
 *      version="2.0",
 *      description="Documentacion de API de practica"
 *  ),
 *  @OA\SecurityScheme(
 *    securityScheme="token",
 *    type="http",
 *    name="Authorization",
 *    in="header",
 *    scheme="Bearer"
 *  )
*/
abstract class Controller
{
}
