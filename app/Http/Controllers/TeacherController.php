<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     *     @OA\get
     *     (
     *     path="/api/teacher",
     *     summary="Obtener lista de profesores",
     *     tags={"Profesor"},
     *     @OA\Parameter(
     *         in="query",
     *         name="name",
     *         required=false
     *      ),
     *      @OA\Parameter(
     *         in="query",
     *         name="description",
     *         required=false
     *      ),
     *     
     *     @OA\Response(
     *         response=200,
     *         description="Una lista de profesores"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
    */
    public function getAll(Request $request)
    {

        $teacher =Teacher::name($request->name)->lastName($request->lastName)->get();
        
        if($teacher->isEmpty())
        {
            return response()->json(['message'=>'No hay profesores'],404);
        }
        return response()->json($teacher,200);
    }
    /**
     *   @OA\get
     *     (
     *     path="/api/teacher/{id}",
     *     summary="Obtener un profesor",
     *     tags={"Profesor"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Un profesor"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
     */
    public function get($id)
    {
        $teacher = Teacher::find($id);
        if(!$teacher)
        {
            return response()->json(['message'=>'No hay profesor'],404);
        }
        return response()->json($teacher,200);
    }
    /**
     * @OA\post(
     *     path="/api/teacher",
     *     summary="crear un profesor",
     *     tags={"Profesor"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Datos necesarios para crear un profesor",
     *         @OA\JsonContent(
     *             required={"name", "lastName"},
     *             @OA\Property(property="name", type="string", example="Gregorio luperon"),
     *             @OA\Property(property="lastName", type="string", example="Bonaire Encarnacion"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Crea un profesor"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     ),
     *  )
     */
    public function create(Request $request)
    {
       $teacher = Teacher::create([
            'name' => $request->name,
            'lastName'=> $request->lastName
       ]);
       if(!$teacher)
       {
           $data = [
                'message'=> 'Error al crear una profesor',
                'status'=> 500
           ];
           return response()->json($data,500);
       }

       $data = [
            'student'=> $teacher,
            'status'=> 201
       ];

       return response()->json($data,201);
    }
    /**
     *   @OA\delete
     *     (
     *     path="/api/teacher/{id}",
     *     summary="eliminar un profesor",
     *     tags={"Profesor"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Un Profesor"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
     */
    public function delete($id)
    {
        $teacher = Teacher::find($id);
        if(!$teacher)
        {
            return response()->json(['message'=>'No hay profesor'],404);
        }
        $teacher->delete();
        $data = [
            'message' => 'Profesor eliminada',
            'status' => 200
        ];
        return response()->json($data,200);
    }
    /**
     *   @OA\put
     *     (
     *     path="/api/teacher/{id}",
     *     summary="actualizar una profesor",
     *     tags={"Profesor"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Datos necesarios para actualizar un profesor",
     *         @OA\JsonContent(
     *             required={"name", "lastName"},
     *             @OA\Property(property="name", type="string", example="Jose"),
     *             @OA\Property(property="lastName", type="string", example="Encarnacion"),
     *             )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Un profesor"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error"
     *     )
     *  )
     */
    public function update(Request $request,$id)
    {
        var_dump($request->name);
        var_dump($request->lastName);
       $teacher = Teacher::findOrFail($id);
     
       if(!$teacher)
       {
           return response()->json(['No se encontro la profesor']);
       }
        
        $teacher->name = $request->name;
        $teacher->lastName = $request->lastName;

        var_dump($request->name);
        var_dump($request->lastName);
        var_dump($teacher->name);
        var_dump($teacher->lastName);

        $teacher->save();
        $data = [
            'profesor'=> $teacher,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
}
