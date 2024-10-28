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
    protected function successfullResponse($data,$message,$code=200)
    {
        $response = [
            'data' =>$data,
            'message'=>$message
        ];
        return response()->json($response,$code);
    }
    protected function successfullCollectionResponse($data,$total,$currentPage,$lastPage)
    {
        $response = [
            'data' =>$data,
            'total'=>$total,
            'currentPage'=>$currentPage,
            'lastPage'=>$lastPage
           
        ];
        return response()->json($response,200);
    }
    protected function ErrorResponse($description)
    {
        $response = [
            'message'=> 'Ocurrio un error, comuniquese con su Administrador',
            'Description' =>$description,
        ];
        return $response;
    }
}
